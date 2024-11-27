<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            // 1. Otomatik artan birincil anahtar sütunu oluşturuluyor.
            $table->id();
        
            // 2. Kullanıcının ID'sini tutmak için `unsignedBigInteger` türünde bir sütun oluşturuluyor.
            $table->unsignedBigInteger('user_id');
        
            // 3. Ürünün ID'sini tutmak için `unsignedBigInteger` türünde bir sütun oluşturuluyor.
            $table->unsignedBigInteger('product_id');
        
            // 4. `user_id` sütunu için `users` tablosuna bir yabancı anahtar (foreign key) tanımlanıyor.
            //    Eğer ilgili kullanıcı silinirse, bu sepet kaydı da otomatik olarak silinecek (`onDelete('cascade')`).
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
            // 5. `product_id` sütunu için `products` tablosuna bir yabancı anahtar tanımlanıyor.
            //    Eğer ürün güncellenirse, bu güncelleme sepet tablosunda da yansıyacak (`onUpdate('cascade')`).
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
        
            // 6. `created_at` ve `updated_at` sütunlarını otomatik olarak ekler (zaman damgaları).
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
