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
            ['name' => 'Book', 'path' => 'book.png', 'is_globel' => true],
            
            // Pengeluaran (Expense Categories) 2-6
            ['name' => 'Food', 'path' => 'food.png', 'is_globel' => true],
            ['name' => 'Transportation', 'path' => 'transportation.png', 'is_globel' => true],
            ['name' => 'Utilities', 'path' => 'utilities.png', 'is_globel' => true],
            ['name' => 'Entertainment', 'path' => 'entertainment.png', 'is_globel' => true],
            ['name' => 'Health', 'path' => 'health.png', 'is_globel' => true],

            // Pemasukan (Income Categories) 7-9
            ['name' => 'Salary', 'path' => 'salary.png', 'is_globel' => true],
            ['name' => 'Investment', 'path' => 'investment.png', 'is_globel' => true],
            ['name' => 'Gift', 'path' => 'gift.png', 'is_globel' => true],

            // Pihak yang Terlibat (Parties) 10-12
            ['name' => 'Vendor', 'path' => 'vendor.png', 'is_globel' => true],
            ['name' => 'Customer', 'path' => 'customer.png', 'is_globel' => true],
            ['name' => 'Bank', 'path' => 'bank.png', 'is_globel' => true],

            // Jenis Akun (Account Types)13 - 15
            ['name' => 'Cash', 'path' => 'cash.png', 'is_globel' => true],
            ['name' => 'Debt', 'path' => 'debt.png', 'is_globel' => true],
            ['name' => 'Receivables', 'path' => 'receivables.png', 'is_globel' => true],

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
            'is_admin' => true,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);

    }
}
