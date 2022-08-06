    @extends('layouts.master')
    @user('css')
        <!-- Internal Data table css -->
        <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @enduser
    @user('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto"> المستخدمين </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/عرض
                        المستخدمين </span>
                </div>
            </div>

        </div>
        <!-- breadcrumb -->
    @enduser
    @user('content')
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
                            <h4 class="card-title mg-b-0"> المستخدمين</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-flip-horizontal"
                            data-toggle="modal" href="#modaldemo1"><i class="fa fa-plus"></i> اضافة مستخدم جديد</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0"> اسم المستخدم </th>
                                        <th class="border-bottom-0">  البريد الإلكتروني </th>
                                        <th class="border-bottom-0"> العمليات</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td>

                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-toggle="modal" href="#edit{{ $user->id }}" title="تعديل"><i
                                                        class="las la-pen">تعديل</i> </a>

                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-toggle="modal" href="#delete{{ $user->id }}" title="حذف"><i
                                                        class="las la-trash">حذف</i> </a>

                                            </td>
                                        </tr>


                                        <!-- Modal edit effects -->
                                        <div class="modal" id="edit{{ $user->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">تعديل المستخدم </h6><button
                                                            aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- فورم تعديل المستخدم --}}
                                                        <form method="post" action="users/update"
                                                            enctype="multipart/form-data" autocomplete="off">
                                                            {{ method_field('patch') }}
                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $user->id }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">اسم المستخدم</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $user->name }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1"> البريد الإلكتروني</label>
                                                                <input type="text" value="{{ $user->email }}" class="form-control" id="email" name="email" required>
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
                                        <div class="modal" id="delete{{ $user->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">حذف المستخدم </h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- فورم حذف رحله --}}
                                                        <form method="post" action="users/destory">
                                                            {{ method_field('delete') }}
                                                            {{ csrf_field() }}
                                                            <input type="text" name="id" id="id"
                                                                value="{{ $user->id }}" class="form-control" hidden>
                                                            <div class="form-group">
                                                                <label for="">هل تريد حذف هذا المستخدم ؟</label>
                                                                <input type="text" name="name" id="name"
                                                                    value="{{ $user->name }}" class="form-control"
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
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> إضافة مستخدم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{-- فورم اضافه دوره جديده --}}
                        <form method="post" action=" {{ route('users.store') }} " enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">إسم المستخدم</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> البريد الإلكتروني</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> كلمة المرور </label>
                                <input type="text" class="form-control" id="passsword" name="passsword" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> تأكيد كلمة المرور</label>
                                <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" required>
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

    @enduser
    @user('js')
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
    @enduser
