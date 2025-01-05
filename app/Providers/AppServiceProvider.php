<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\Str;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('dateForID', function (String $inputDate, String $to_format, String $from_format = 'Y-m-d') {
            $date = DateTime::createFromFormat($from_format, $inputDate);
            if($date){
                // Format output:
                $formattedDate = $date->format($to_format);
                $translatedDate = str_replace(
                    ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    $formattedDate
                );
                $translatedDate = str_replace(
                    ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    $translatedDate
                );
                return $translatedDate;
            }
            return "Error dateForID";
        });
        
        Str::macro('toRupiah', function($nominal, bool $negatif = true){
            if($nominal >= 0) return 'Rp'.number_format($nominal, 0, ',', '.').',-';
            else if($nominal < 0) return ($negatif ? '-' : '').'Rp'.number_format($nominal*-1, 0, ',', '.').',-'; 
        });
        Collection::macro('totalByType', function(string $type, string $sum = 'nominal'){
            return $this->sum(function($r) use ($type, $sum){
                switch (get_class($r)) {
                    case 'Illuminate\Support\Collection':
                        return $r->totalByType($type);
                    default:
                        return ($r->$sum !== null ? ($r['type'] === $type ? $r->$sum : 0) : 0);
                }
            });
        });


        // MoneyNode
        Collection::macro('totalByIncomeExpense', function(){
            return $this->totalByType('income') - $this->totalByType('expense');
        });
        Collection::macro('totalNominalInAccount', function(array $transfer){
            return $this->totalByType('income') - $this->totalByType('expense') + $transfer['toMe']->totalByType('transfer') - $transfer['fromMe']->totalByType('transfer');
        });
        Collection::macro('totalNominalGroupAccounts', function(){
            return $this->sum(function($account){
                return $account->records->totalNominalInAccount(['toMe' => $account->transferToMe, 'fromMe'=>$account->transferFromMe]);
            });
        });
        Collection::macro('totalAssetBersih', function(){
            // $this = semua account dari buku (sudah dipecah berdasarkan type account)
            // kita harus jumlahkan pecah lagi menjadi asset atau tidak
            return $this->sum(function($account_type){
                // dd($account_type->groupBy('is_asset')->sort()->last());
                return $account_type->groupBy('is_asset')->sort()->last()->totalNominalGroupAccounts();
            });
        });
    }
}
