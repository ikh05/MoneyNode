<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\Str;

use Illuminate\Support\Number;
use App\Models\TransactionRecord;
use Collator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use PHPUnit\Runner\DeprecationCollector\Collector;

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
        Str::macro('dateForID', function (String $inputDate, String $format = 'l, d F Y') {
            $date = DateTime::createFromFormat('Y-m-d', $inputDate);
            if($date){
                // Format output:
                $formattedDate = $date->format($format);
                $translatedDate = str_replace(
                    ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
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
        Collection::macro('totalByType', function($type){
            return $this->sum(function($r) use ($type){
                return ($r['type'] === $type ? $r['nominal'] : 0);
            });
        });
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
