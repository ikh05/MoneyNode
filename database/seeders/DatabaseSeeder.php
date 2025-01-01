<?php

namespace Database\Seeders;

use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Icon;
use App\Models\User;
use App\Models\Account;
use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;
use App\Models\TransactionParty;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $icons = [
            // Buku 1
            ['name' => 'Book', 'path' => 'book.png', 'isGlobel' => true],
            
            // Pengeluaran (Expense Categories) 2-6
            ['name' => 'Food', 'path' => 'food.png', 'isGlobel' => true],
            ['name' => 'Transportation', 'path' => 'transportation.png', 'isGlobel' => true],
            ['name' => 'Utilities', 'path' => 'utilities.png', 'isGlobel' => true],
            ['name' => 'Entertainment', 'path' => 'entertainment.png', 'isGlobel' => true],
            ['name' => 'Health', 'path' => 'health.png', 'isGlobel' => true],

            // Pemasukan (Income Categories) 7-9
            ['name' => 'Salary', 'path' => 'salary.png', 'isGlobel' => true],
            ['name' => 'Investment', 'path' => 'investment.png', 'isGlobel' => true],
            ['name' => 'Gift', 'path' => 'gift.png', 'isGlobel' => true],

            // Pihak yang Terlibat (Parties) 10-12
            ['name' => 'Vendor', 'path' => 'vendor.png', 'isGlobel' => true],
            ['name' => 'Customer', 'path' => 'customer.png', 'isGlobel' => true],
            ['name' => 'Bank', 'path' => 'bank.png', 'isGlobel' => true],

            // Jenis Akun (Account Types)13 - 15
            ['name' => 'Cash', 'path' => 'cash.png', 'isGlobel' => true],
            ['name' => 'Debt', 'path' => 'debt.png', 'isGlobel' => true],
            ['name' => 'Receivables', 'path' => 'receivables.png', 'isGlobel' => true],

        ];

        // Insert data ke tabel icons
        foreach ($icons as $icon) {
            Icon::create($icon);
        }
        // create user
        $password = '12345';
        $user = User::create([
            'username' => 'Ikhsan',
            'name' => 'ikhsan',
            'isAdmin' => true,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);

    }
}
