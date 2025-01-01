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
            ['uploader_id' => 1, 'name' => 'Book', 'path' => 'book.png', 'isGlobel' => true],
            
            // Pengeluaran (Expense Categories) 2-6
            ['uploader_id' => 1, 'name' => 'Food', 'path' => 'food.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Transportation', 'path' => 'transportation.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Utilities', 'path' => 'utilities.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Entertainment', 'path' => 'entertainment.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Health', 'path' => 'health.png', 'isGlobel' => true],

            // Pemasukan (Income Categories) 7-9
            ['uploader_id' => 1, 'name' => 'Salary', 'path' => 'salary.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Investment', 'path' => 'investment.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Gift', 'path' => 'gift.png', 'isGlobel' => true],

            // Pihak yang Terlibat (Parties) 10-12
            ['uploader_id' => 1, 'name' => 'Vendor', 'path' => 'vendor.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Customer', 'path' => 'customer.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Bank', 'path' => 'bank.png', 'isGlobel' => true],

            // Jenis Akun (Account Types)13 - 15
            ['uploader_id' => 1, 'name' => 'Cash', 'path' => 'cash.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Debt', 'path' => 'debt.png', 'isGlobel' => true],
            ['uploader_id' => 1, 'name' => 'Receivables', 'path' => 'receivables.png', 'isGlobel' => true],

        ];

        // create user
        $password = '12345';
        $user = User::create([
            'username' => 'Ikhsan',
            'name' => 'ikhsan',
            'isAdmin' => true,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);

        // Insert data ke tabel icons
        foreach ($icons as $icon) {
            Icon::create($icon);
        }

        $user->__default();
    }
}
