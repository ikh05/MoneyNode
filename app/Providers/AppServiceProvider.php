<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\Str;

use Illuminate\Support\Number;
use App\Models\TransactionRecord;
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
        
        Collection::macro('sumIf', function(String $s, String $fk, String $fv){
            return $this->sum(function($item) use ($fk, $fv, $s){
                return $fv === $item[$fk] ? $item[$s] : 0;
            });
        });

        Collection::macro('sumIfs', function(String $s, Array $filter){
            return $this->sum(function($item) use ($s, $filter){
                // harus mengeluarkan nilai yang di jumlahkan
                // cek item itu berapa banyak memenuhi kriteria
                    // setiap filter kita bandingkan dengan setiap item
                    // jika sama dengan banyak filter, maka di jumlahkan
                return (Collection::make($filter)->sum(function($fv, $fk){
                    dd($fk." => ".$fv);
                }) === count($filter)) ? $item[$s] : 0; 
            });
        });
    }
}
