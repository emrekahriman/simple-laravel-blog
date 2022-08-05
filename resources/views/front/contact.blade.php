@extends('front.layouts.master')
@section('title', 'İletişim | Emrekhrmn')
@section('main')
                <div class="col-md-10">
                @if (session('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <li class="bg-transparent border-0 p-0 list-group-item d-flex  align-items-center"><span class="badge badge-danger badge-pill mr-3">!</span>
                                {{ $error }}
                            </li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>
                <div class="col-md-10">
                    <div class="contact-form bg-dark">
                        <h1 class="text-white add-letter-space mb-5">Bizimle İletişime Geçin!</h1>
                        <form method="POST" action="{{ route('contact.post') }}" class="needs-validation">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="firstName" class="text-black-300">Adınızı Girin</label>
                                        <input type="text" id="firstName" name="name" value="{{ old('name') }}" class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0" placeholder="Emre Kahriman" required>
                                        <p class="invalid-feedback">Your first-name is required!</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="email" class="text-black-300">E-Mail Adresinizi Girin</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0" placeholder="emre.kahriman@mail.com" required>
                                        <p class="invalid-feedback">Your email is required!</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="text-black-300">İlgili Konuyu Seçin</label>
                                        <select class="d-block w-100" name="topic" required>
                                            <option @if(old('topic') == 'Genel') selected @endif value="Genel">Genel</option>
                                            <option @if(old('topic') == 'Bilgi') selected @endif value="Bilgi">Bilgi</option>
                                            <option @if(old('topic') == 'Destek') selected @endif value="Destek">Destek</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label for="message" class="text-black-300">Mesajınızı Girin</label>
                                        <textarea name="message" name="message" class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0" placeholder="Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan..." required>{{ old('message') }}</textarea>
                                        <p class="invalid-feedback">Message is required!</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary">Gönder <img src="{{ asset('front') }}/images/arrow-right.png" alt=""></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@endsection