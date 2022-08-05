<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('image');
            $table->integer('hit')->default(0);
            $table->integer('status')->default(1)->comment('0:pasif 1:aktif');
            $table->softDeletes();
            $table->timestamps();

            // categori_id alanini categoriler tablosundaki id alanina bagliyoruz
            // cascade ile categori silinirse ona ait articles'lar da silinsin diyoruz
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
