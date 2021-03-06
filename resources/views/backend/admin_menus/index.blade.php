@extends('backend.index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('backend.menu') }}
            <small>{{ $description or trans('backend.list') }}</small>
        </h1>

        <!-- breadcrumb start -->
        @if (!empty($breadcrumb))
            <ol class="breadcrumb" style="margin-right: 30px;">
                <li><a href="{{ backend_url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                @foreach($breadcrumb as $item)
                    @if($loop->last)
                        <li class="active">
                            @if (array_has($item, 'icon'))
                                <i class="fa fa-{{ $item['icon'] }}"></i>
                            @endif
                            {{ $item['text'] }}
                        </li>
                    @else
                        <li>
                            <a href="{{ backend_url(array_get($item, 'url')) }}">
                                @if (array_has($item, 'icon'))
                                    <i class="fa fa-{{ $item['icon'] }}"></i>
                                @endif
                                {{ $item['text'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
    @endif
    <!-- breadcrumb end -->

    </section>

    <section class="content">

        @include('backend.partials.error')
        @include('backend.partials.success')
        @include('backend.partials.exception')
        @include('backend.partials.toastr')

        <div class="row">
            <div class="col-md-6">
                {!! $treeView !!}
            </div>
            <div class="col-md-6">
                {{--Create Form Start--}}
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('backend.create') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ get_resource() }}" method="post" accept-charset="UTF-8" class="form-horizontal" pjax-container>

                        <div class="box-body">
                            <div class="fields-group">
                                {{--Fields Start--}}
                                <div class="form-group {!! !$errors->has('parent_id') ? '' : 'has-error' !!}">
                                    <label for="parent_id" class="col-sm-2 control-label">{{ $columns['parent_id'] }}</label>
                                    <div class="col-sm-8">
                                        @if($errors->has('parent_id'))
                                            @foreach($errors->get('parent_id') as $message)
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                            @endforeach
                                        @endif

                                        <select class="form-control parent_id" name="parent_id" style="width: 100%;" >
                                            @foreach($menus as $mk => $menu)
                                                <option value="{{ $mk }}"  >{{ $menu }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group {!! !$errors->has('title') ? '' : 'has-error' !!}">
                                    <label for="title" class="col-sm-2 control-label">{{ $columns['title'] }}</label>
                                    <div class="col-sm-8">
                                        @if($errors->has('title'))
                                            @foreach($errors->get('title') as $message)
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                            @endforeach
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" id="title" name="title" value="" class="form-control title" placeholder="{{ trans('backend.input') }} {{ $columns['title'] }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {!! !$errors->has('icon') ? '' : 'has-error' !!}">
                                    <label for="icon" class="col-sm-2 control-label">{{ $columns['icon'] }}</label>
                                    <div class="col-sm-8">
                                        @if($errors->has('icon'))
                                            @foreach($errors->get('icon') as $message)
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                            @endforeach
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <input style="width: 140px;" type="text" id="icon" name="icon" value="fa-bars" class="form-control icon" placeholder="{{ trans('backend.input') }} {{ $columns['icon'] }}">
                                        </div>
                                            <span class="help-block">
                                                <i class="fa fa-info-circle"></i>For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>
                                            </span>
                                    </div>
                                </div>

                                <div class="form-group {!! !$errors->has('uri') ? '' : 'has-error' !!}">
                                    <label for="uri" class="col-sm-2 control-label">{{ $columns['uri'] }}</label>
                                    <div class="col-sm-8">
                                        @if($errors->has('uri'))
                                            @foreach($errors->get('uri') as $message)
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                            @endforeach
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" id="uri" name="uri" value="" class="form-control uri" placeholder="{{ trans('backend.input') }} {{ $columns['uri'] }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {!! !$errors->has('roles') ? '' : 'has-error' !!}">
                                    <label for="roles" class="col-sm-2 control-label">{{ $columns['roles'] }}</label>
                                    <div class="col-sm-8">
                                        @if($errors->has('roles'))
                                            @foreach($errors->get('roles') as $message)
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label><br/>
                                            @endforeach
                                        @endif

                                        <select class="form-control roles" name="roles[]" style="width: 100%;" multiple >
                                            @foreach($roles as $pk => $role)
                                                <option value="{{ $pk }}"  >{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--Fields End--}}
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-2">

                            </div>

                            <div class="col-md-8">
                                {{--Submit Button Start--}}
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> $text">{{ trans('backend.submit') }}</button>
                                </div>
                                {{--Submit Button End--}}

                                {{--Reset Button Start--}}
                                <div class="btn-group pull-left">
                                    <button type="reset" class="btn btn-warning">{{ trans('backend.reset') }}</button>
                                </div>
                                {{--Reset Button End--}}
                            </div>

                        </div>
                        {{--Hidden Fields Start--}}
                        <input type="hidden" name="_previous_" value="{{ get_resource() }}" class="_previous_">
                    {{--Hidden Fields End--}}
                    <!-- /.box-footer -->
                    </form>
                </div>
                {{--Create Form End--}}
            </div>
        </div>


    </section>
@endsection
@section('page_script')
    <script>
        $(function () {
            $(".parent_id").select2({"allowClear":true,"placeholder":"{{ trans('backend.input') }} {{ trans('backend.menu') }}"});

            $('.icon').iconpicker({placement:'bottomLeft'});

            $(".roles").select2({"allowClear":true,"placeholder":"{{ trans('backend.input') }} {{ trans('backend.role') }}"});
        });
    </script>
@endsection