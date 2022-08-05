@extends('back.layouts.master')
@section('title', 'Genel Ayarlar')

@section('main')
                    <div class="row">
                        <div class="col-12">
                            <!-- Content Row -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <span class="m-0 font-weight-bold text-primary">@yield('title')</span>
                                </div>
                                <div class="card-body">
                                    <form
                                    method="post"
                                    action="{{route('admin.setting.update')}}"
                                    enctype="multipart/form-data"
                                    >
                                    @csrf
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Başlığı</label>
                                          <input
                                            type="text"
                                            name="title"
                                            required
                                            class="form-control"
                                            value="{{$setting->title}}"
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Aktiflik Durumu</label>
                                          <select class="form-control" name="active">
                                            <option @if($setting->active==1) selected @endif value="1">Açık
                                            </option>
                                            <option @if($setting->active==0) selected @endif value="0">Kapalı
                                            </option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Site Description</label>
                                                <textarea name="description" class="form-control" id="floatingTextarea">{{ $setting->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Site Keywords</label>
                                            <input
                                              type="text"
                                              class="form-control"
                                              name="keywords"
                                              value="{{$setting->keywords}}"
                                            />
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Site Author</label>
                                            <input
                                              type="text"
                                              class="form-control"
                                              name="author"
                                              value="{{$setting->author}}"
                                            />
                                          </div>
                                        </div>
                                      </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Logo</label>
                                          <input type="file" class="form-control" name="logo" accept="image/png" />
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Favicon</label>
                                          <input type="file" class="form-control" name="favicon" accept="image/png" />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Facebook</label>
                                          <input
                                            type="text"
                                            class="form-control"
                                            name="facebook"
                                            value="{{$setting->facebook}}"
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Twitter</label>
                                          <input
                                            type="text"
                                            class="form-control"
                                            name="twitter"
                                            value="{{$setting->twitter}}"
                                          />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Github</label>
                                          <input
                                            type="text"
                                            class="form-control"
                                            name="github"
                                            value="{{$setting->github}}"
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>LinkIn</label>
                                          <input
                                            type="text"
                                            class="form-control"
                                            name="linkedin"
                                            value="{{$setting->linkedin}}"
                                          />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Youtube</label>
                                          <input
                                            type="text"
                                            class="form-control"
                                            name="youtube"
                                            value="{{$setting->youtube}}"
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Instagram</label>
                                          <input
                                            type="text"
                                            class="form-control"
                                            name="instagram"
                                            value="{{$setting->instagram}}"
                                          />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-block btn-md btn-primary">
                                        Ayarları Güncelle
                                      </button>
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
