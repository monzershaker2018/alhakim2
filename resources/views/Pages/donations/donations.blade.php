@extends('layouts.master')
@section('title')
    لوحة التحكم - التبرعات
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> التبرعات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/عرض
                    التبرعات </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            {{-- عرض الاخطاء --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> التبرعات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <a class="modal-effect btn btn-primary btn-block" data-effect="effect-flip-horizontal"
                        data-toggle="modal" href="#modaldemo1"><i class="fa fa-plus"></i> اضافة تبرع جديد</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0"> اسم المتبرع</th>
                                    <th class="border-bottom-0"> رقم الهاتف </th>
                                    <th class="border-bottom-0"> الوصف </th>
                                    <th class="border-bottom-0"> المبلغ </th>
                                    <th class="border-bottom-0"> تاريخ التبرع </th>
                                    <th class="border-bottom-0"> العمليات</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($donations as $donation)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $donation->name }}</td>
                                        <td>{{ $donation->phone }}</td>
                                        <td>{{ $donation->desc }}</td>
                                        <td>{{ $donation->price }}</td>
                                        <td>{{ $donation->date }}</td>

                                        <td>

                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $donation->id }}" title="تعديل"><i
                                                    class="fa fa-edit"> </i> تعديل </a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $donation->id }}" title="حذف"><i
                                                    class="fa fa-trash"> </i> حذف </a>


                                        </td>
                                    </tr>


                                    <!-- Modal edit effects -->
                                    <div class="modal" id="edit{{ $donation->id }}">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">تعديل التبرع </h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- فورم تعديل اسم التبرع --}}
                                                    <form method="post" action="donations/update"
                                                        enctype="multipart/form-data" autocomplete="off">
                                                        {{ method_field('patch') }}
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <input type="hidden" name="id" id="id"
                                                                value="{{ $donation->id }}">
                                                        </div>


                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1"> اسم المتبرع</label>
                                                                    <input type="text" class="form-control" required
                                                                        name="name" value="{{ $donation->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1"> رقم الهاتف </label>
                                                                    <input type="text" class="form-control" required
                                                                        name="phone" value="{{ $donation->phone }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1"> التاريخ</label>
                                                                    <input type="date" class="form-control" required
                                                                        name="date" value="{{ $donation->date }}">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1"> المبلغ </label>
                                                                    <input type="text" class="form-control" required
                                                                        name="price" value="{{ $donation->price }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1"> الوصف</label>
                                                                    <textarea class="form-control" name="desc" cols="5" rows="5">{{ $donation->desc }}</textarea>

                                                                </div>
                                                            </div>

                                                        </div>








                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" type="submit">تعديل </button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                        type="button">اغلاق</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- End edit Modal effects-->


                                    <!-- Modal delete effects -->
                                    <div class="modal" id="delete{{ $donation->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">حذف التبرع </h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- فورم حذف رحله --}}
                                                    <form method="post" action="donations/destory">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <input type="text" name="id" id="id" value="{{ $donation->id }}"
                                                            class="form-control" hidden>
                                                        <div class="form-group">
                                                            <label for="">هل تريد حذف التبرع ؟</label>
                                                            <input type="text" name="name" id="name"
                                                                value="{{ $donation->name }}" class="form-control"
                                                                readonly>
                                                        </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" type="submit">تاكيد </button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                        type="button">اغلاق</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- End edit Modal effects-->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div> <!-- row closed -->

    <!-- create Modal effects -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> إضافة تبرع</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    {{-- فورم اضافه دوره جديده --}}
                    <form method="post" action=" {{ route('donations.store') }} " enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> اسم المتبرع</label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> رقم الهاتف </label>
                                    <input type="text" class="form-control" required name="phone">
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> التاريخ</label>
                                    <input type="date" class="form-control" required name="date">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> المبلغ</label>
                                    <input type="text" class="form-control" required name="price">
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> الوصف</label>
                                    <textarea class="form-control" name="desc" cols="5" rows="5"></textarea>

                                </div>
                            </div>
                        </div>






                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal effects-->



    </div> <!-- Container closed -->

    </div> <!-- main-content closed -->

@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
@endsection
