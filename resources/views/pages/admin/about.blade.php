@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="row mb-5">
        <div class="col-md-12" id="boxTable">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="card-header-left my-3">
                        <h5 class="text-uppercase title">Tentang Kami</h5>
                    </div>
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                            <li class="nav-item submenu">
                                <a class="nav-link active" data-toggle="tab" href="#webinfo" role="tab" id="tabInfo"
                                    aria-selected="false">Info Website</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" data-toggle="tab" href="#sosmed" role="tab" id="tabSosmed"
                                    aria-selected="false">Sosial Media</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formSetting" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="tab-pane active" id="webinfo" (role="tabpanel")>

                        </div>
                        <div class="tab-pane" id="sosmed">

                        </div>
                        <div class="text-right mt-3 mb-3">
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugin/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            $("#webinfo").load("/admin/about/webinfo", function() {
                getData();
                $('#summernote').summernote({
                    placeholder: 'masukkan deskripsi profile',
                    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                    tabsize: 2,
                    height: 300
                });
            })
            $("#sosmed").load("/admin/about/sosmed")

            $(".tab-pane").hide()
            $("#webinfo").show()

            $("#tabInfo").click(function() {
                showTab("webinfo")
            })

            $("#tabSosmed").click(function() {
                showTab("sosmed")
            })
        })

        $("#formSetting").submit(function(e) {
            e.preventDefault()

            let formData = new FormData();
            formData.append("id", parseInt($("#id").val()));
            formData.append("address", $("#address").val());
            formData.append("description", $("#summernote").summernote('code'));
            formData.append("location", $("#location").val());
            formData.append("whatsapp", $("#whatsapp").val());
            formData.append("telegram", $("#telegram").val());
            formData.append("email", $("#email").val());
            formData.append("twitter", $("#twitter").val());
            formData.append("youtube", $("#youtube").val());
            formData.append("linkedin", $("#linkedin").val());

            if ($("#id").val()) {
                formData.append("action", "update");
            } else {
                formData.append("action", "create");
            }

            createAndUpdate(formData);
            return false;
        });

        function showTab(tabName) {
            $(".tab-pane").hide();
            $('#' + tabName).show();
        }


        function getData() {
            $.ajax({
                url: "/api/admin/about/detail",
                dataType: "json",
                success: function(data) {
                    let d = data.data;
                    $("#id").val(d.id);
                    $("#address").val(d.address);
                    $("#summernote").summernote('code', d.description);
                    $("#whatsapp").val(d.whatsapp);
                    $("#telegram").val(d.telegram);
                    $("#email").val(d.email);
                    $("#twitter").val(d.twitter);
                    $("#youtube").val(d.youtube);
                    $("#linkedin").val(d.linkedin);
                    $("#location").val(d.location);
                    if (d.location && d.maps_preview) {
                        $("#maps_preview").empty().append(d.maps_preview);
                    }
                },
                error: function(err) {
                    console.log("error :", err)
                }

            })
        }

        function createAndUpdate(data) {
            $.ajax({
                url: "/api/admin/about/create-update",
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    console.log("Loading...")
                },
                success: function(res) {
                    getData()
                    showMessage("success", "flaticon-alarm-1", "Sukses", res.message);
                },
                error: function(err) {
                    console.log("error :", err)
                    showMessage("danger", "flaticon-error", "Peringatan", err.message || err.responseJSON
                        ?.message)
                }
            })
        }
    </script>
@endpush
