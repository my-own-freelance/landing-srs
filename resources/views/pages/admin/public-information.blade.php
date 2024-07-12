@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="row mb-5">
        <div class="col-md-12" id="boxTable">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="card-header-left my-3">
                        <h5 class="text-uppercase title">Informasi Publik</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formCountInformation">
                        <input type="hidden" name="id" id="id">
                        <div class="tab-pane active" id="countinformation" (role="tabpanel")>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="judul informasi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Deskripsi</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="deskripsi informasi">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Jumlah Pelanggan Senang</label>
                                        <input type="number" class="form-control" id="happy_client" name="happy_client"
                                            placeholder="jumlah pelanggan senang">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Pengiriman Sukses</label>
                                        <input type="number" class="form-control" id="complete_shipment"
                                            name="complete_shipment" placeholder="jumlah pengiriman sukses">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Jumlah Review Pelanggan</label>
                                        <input type="number" class="form-control" id="customer_review"
                                            name="customer_review" placeholder="jumlah review pelanggan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Kontak Kami</label>
                                        <input type="text" class="form-control" id="contact_us" name="contact_us"
                                            placeholder="nomor telpon kami">
                                    </div>
                                </div>
                            </div>

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
    <script>
        $(function() {
            getData()
        })

        $("#formCountInformation").submit(function(e) {
            e.preventDefault()

            let formData = new FormData();
            formData.append("id", parseInt($("#id").val()));
            formData.append("title", $("#title").val());
            formData.append("description", $("#description").val());
            formData.append("contact_us", parseInt($("#contact_us").val()));
            formData.append("happy_client", parseInt($("#happy_client").val()));
            formData.append("complete_shipment", parseInt($("#complete_shipment").val()));
            formData.append("customer_review", $("#customer_review").val());

            createAndUpdate(formData);
            return false;
        });

        function getData() {
            $.ajax({
                url: "/api/admin/public-information/detail",
                dataType: "json",
                success: function(data) {
                    let d = data.data;
                    $("#id").val(d.id);
                    $("#title").val(d.title);
                    $("#description").val(d.description);
                    $("#contact_us").val(d.contact_us);
                    $("#happy_client").val(d.happy_client);
                    $("#complete_shipment").val(d.complete_shipment);
                    $("#customer_review").val(d.customer_review);

                },
                error: function(err) {
                    console.log("error :", err)
                }

            })
        }

        function createAndUpdate(data) {
            $.ajax({
                url: "/api/admin/public-information/create-update",
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
