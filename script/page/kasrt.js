
/* history s */
jQuery(document).ready(function($) {

    if (window.history && window.history.pushState) {
    
      $(window).on('popstate', function() {
        var hashLocation = location.hash;
        var hashSplit = hashLocation.split("#!/");
        var hashName = hashSplit[1];
    
        if (hashName !== '') {
          var hash = window.location.hash;
          if (hash === '') {
              /* close form */
                form1cl();
    
    
              /* make window back not avaliable */
              (function (global) { 
    
              if(typeof (global) === "undefined") {
                  throw new Error("window is undefined");
              }
    
              var _hash = "!";
              var noBackPlease = function () {
                  global.location.href += "";
    
                  /* making sure we have the fruit available for juice (^__^) */
                  global.setTimeout(function () {
                      global.location.href += "";
                  }, 50);
              };
    
              global.onhashchange = function () {
                  if (global.location.hash !== _hash) {
                      global.location.hash = _hash;
                  }
              };
    
              global.onload = function () {            
                  noBackPlease();         
              }
    
              })(window);
          }
        }
      });
    
      window.history.pushState('forward', null, './#forward');
    }
    
});
/* history e */

function btnbkash(){
    form1op("Buat Kas", "Nama Kas : <input class='form form-control' id='bniksh' type='text' onkeyup=\"limiter('40', 'bniksh', 'textnumbersimplesymbol');\">", "<button id='btnkashjax' class='btn btn-success' onclick='kashjax();'>Buat</button>");
}
var ajaxkh = null;
function kashjax(){
    if(ajaxkh){
        ajaxkh.abort();
    }
    var name = $("#bniksh").val();
    if(name == ""){

    }else{
        $("#btnkashjax").html("Loading...");
        $("#btnkashjax").prop("disabled", true);
        fpl2s();
        ajaxkh = $.ajax({
            method:"post",
            url:"khi.php",
            data:{
                name:name
            },
            dataType:"json",
            error:function(){
                fpl2e();
                errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
            },
            success:function(data){
                if(data.error == "error"){
                
                }else if(data.error == "err90"){
                    errordiv1s("ERROR", "Terjadi Kesalahan, Harap Coba Lagi Nanti ", "10", "error");
                    $("#btnkashjax").html("Simpan");
                    $("#btnkashjax").prop("disabled", false);
                    fpl2e();
                }
                if(data.avaliable == "no"){
                    form1op("Kas Penuh",
                    "<div style='text-align: justify;'>Maaf Tampaknya Kas Anda Penuh, Silahkan Klik Tombol Dibawah Untuk MengUpgrade Tipe Grup Anda Untuk Mendapatkan Penyimpanan Yang Lebih Banyak, Atau Hapus Kas Yang Sudah Tidak Digunakan<br><br><div style='text-align: center'><button class='btn btn-info'>Upgrade</button></div></div>",
                    "", "");
                    fpl2e();
                }else{
                    form1cl();
                    $("#btnkashjax").prop("disabled", false);
                    get_kas_header();
                }
            }
        });
    }
}

$(document).ready(function () {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['picture', 'video']],
            ['height', ['height']],
            ['view', ['help']],
        ],
        lang: "id-ID",
        dialogsInBody: true,
        dialogsFade: true,
        tabDisable: true,
        codeviewFilter: true,
        codeviewIframeFilter: true,
        disableDragAndDrop: true,
        callbacks: {
            onImageUpload : function(files) {
                var files = files;
                
                for (var i = 0, f; f = files[i]; i++) {

                    // Only process image files.

                    var reader = new FileReader();

                    // Closure to capture the file information.
                    reader.onload = (function(theFile) {
                        return function(e) {
                            $("#summernote_textarea").summernote("pasteHTML", "<img class='summernote-responsive-img' src='"+e.target.result+"' style='width: 100%;height: auto'>");
                        };
                    })(f);

                    // Read in the image file as a data URL.
                    reader.readAsDataURL(f);
                    }

            },
            onChange : function(contents, $editable){
                var max_size = 1;
                var max_size_byte = encodeURI(contents).split(/%..|./).length+1;
                var max_size_kb = max_size_byte / 1024;
                $("#divoutput2_b").html(parseFloat(max_size_kb)+"kb / "+max_size+"kb");
                if(max_size_kb >= max_size){
                    $("#divoutput2_b").html("<a style='color: white;background-color: red;'>Melebihi UKURAN MAKSIMAL</a>");
                    $("#summernote_save_btn").html("Melebihi UKURAN MAKSIMAL").prop("disabled", true);
                }else{
                    $("#summernote_save_btn").html("Simpan").prop("disabled", false);
                }
            }
        }
    });
});




var kas_code_use = null;
var kas_text_use = null;
var kas_id_use = null;
var lhtkashjax = null;
var khoutdomori = null;
var summernote_text_save = null;

$(document).ready(function(){
    get_kas_header();
});
window.onscroll = function() {
    scrollfunc();
};

function scrollfunc() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var finwinScroll = Math.ceil(winScroll);
    if(finwinScroll >= height){

    }
}

function divbodyin(){
    $("#divbody").removeClass("ld-float-ltr-out").addClass("ld-float-rtl-in");
}
function divbodyout(){
    $("#divbody").removeClass("ld-float-rtl-in").addClass("ld-float-ltr-out");
}

function get_kas_header(offset){
    khoutdomori = "";
    divbodyout();
    var sort = $("#datasorting").val();
    var dataperpage = $("#dataperpage").val();
    disableScroll();
    fpl2s();
    $.ajax({
        method:"post",
        url:"get_kas_head2.php",
        data:{
            stat:"stat",
            offset:offset,
            limit:dataperpage,
            sort:sort
        },
        dataType:"json",
        error:function(){
            fpl2e();
            errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
        },
        success:function(data){
            var htmlout = "";
            enableScroll();
            if(data.status == "0kas"){
                htmlout = "Kas Kosong";
                $("#hydpbtn").fadeOut();
            }else if(data.status == "reload"){
                get_kas_header(data.offset_reload);
            }else if(data.status == "1"){
                $("#hydpbtn").fadeIn();
                if(offset != null){
                    document.getElementById('get_kas_header_scrool').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
                var animdur = 0.25;
                var a = 1;
                for(i = 0;i < data.getlen;i++){
                    var no = data.result[i].no;
                    var nama = data.result[i].nama;
                    var kas_code = data.result[i].kas_code;
                    var button = data.button[i].button;

                    htmlout += "<tr class='trgkhz1 ld ld-float-rtl-in' id='trgkh"+a+"' attrkcod='"+kas_code+"' style='animation-duration: "+animdur+"s;'>"+
                                    "<td class='khtd1'>"+no+".</td>"+
                                    "<td class='khtd2' id='tdblhkh"+a+"'>"+nama+"</td>"+
                                    "<td id='bartd3_a_"+a+"' class='khtd3' ><button id='blhkh"+a+"' style='transition: 1s;' onclick=\"lhtkash1('"+kas_code+"', 'blhkh"+a+"');\" class='btntk btn btn-dark'>Lihat</button> "+
                                    button+"</td>"+
                                "</tr>"+
                                "<tr class='trgkhz2'>"+
                                    "<td id='bartd3_b_"+a+"' colspan='3' style='text-align: right;'><button id='blhkh"+a+"' style='transition: 1s;' onclick=\"lhtkash1('"+kas_code+"', 'blhkh"+a+"');\" class='btn btn-dark'>Lihat</button> "+
                                    button+"</td>"+
                                "</tr>"+
                                "<tr class='trhr'>"+
                                    "<td COLSPAN='3'><br><br></td>"+
                                "</tr>";
                    
                    animdur = animdur+0.25;
                    a++;
                }

                var pagenow = data.pagenow;
                var totalpage = data.totalpage;
                var nextpage = data.nextoffset;
                var previouspage = data.previousoffset;

                htmlout += "<tr class='trgkh'>"+
                                "<td COLSPAN='3' style='text-align: center;'>";
                                if(pagenow == 1){
                                    htmlout += "<button class='btntk2 btn btn-success ld ld-jump-alt-in' disabled>Sebelumnya</button><div class='breakcms'><br></div>";
                                }else{
                                    htmlout += "<button class='btntk2 btn btn-success ld ld-jump-alt-in' onclick=\"get_kas_header('"+previouspage+"')\" id='prevpagebtn'>Sebelumnya</button><div class='breakcms'><br></div>";
                                }
                                htmlout += "<span class='btntk2'> Halaman "+pagenow+" / "+totalpage+" </span>";
                                if(totalpage == 1){
                                    htmlout += "<div class='breakcms'><br></div><button class='btntk2 btn btn-success ld ld-jump-alt-in' disabled>Selanjutnya</button>";
                                }else if(pagenow == totalpage){
                                    htmlout += "<div class='breakcms'><br></div><button class='btntk2 btn btn-success ld ld-jump-alt-in' disabled>Selanjutnya</button>";
                                }else{
                                    htmlout += "<div class='breakcms'><br></div><button class='btntk2 btn btn-success ld ld-jump-alt-in' onclick=\"get_kas_header('"+nextpage+"')\" id='nextpagebtn'>Selanjutnya</button>";
                                }
                            htmlout += "</tr>";

                $("#khout").attr("kastotal", data.attrkastotal).attr("idkhlhbtn", data.attridkhlhbtn).attr("idkhdelbtn", data.attridkhdelbtn);

                khoutdomori = htmlout;
            }else{
                form1err();
            }

            setTimeout(function(){
                fpl2e();
                $("#khout").html(htmlout);
                setTimeout(function(){
                    divbodyin();
                }, 200);
            }, 500);
        }
    });
}

function lhtkash1(code, id, title){
    get_last_screen_position();
    kas_code_use = code;
    kas_id_use = id;
    $("#"+id).html("<div style='display: inline-block;' class='ld ld-rubber-h'>Loading</div> <a class='ld ld-ring ld-cycle'></a>");
    $("#"+id).prop("disabled", true);
    var text = null;
    if(title != null){
        text = title;
    }else{
        text = $("#td"+id).html();
    }
    kas_text_use = text;
    $("#hydpbtn3").attr({"code": code},{"title":text});
    setTimeout(function(){
        form1op("<h5>"+text+"<button class='btn btn-link' onclick=\"edkht('"+text+"', '"+code+"', '"+id+"')\";>Ubah</button></h5>",
        "<div style='text-align: center;'><button style='width: 90%;' onClick=\"get_kas_cat('"+code+"')\" class='btn btn-primary'>Lihat Catatan</button><br><br>"+
        "<button style='width: 90%;' class='btn btn-primary' onclick=\"lhtkash2('"+code+"', '"+id+"');blosel(this);\">Lihat Kas</button></div>",
        "");

        $("#"+id).prop("disabled", false);
        $("#"+id).html("Lihat");
    }, 500);
}
function lhtkash2(code, id){
    divbodyout();
    disabledelkhbtn();
    fpl2s();
    form1cl();
    $("#"+id).html("<div style='display: inline-block;' class='ld ld-rubber-h'>Loading</div> <a class='ld ld-ring ld-cycle'></a>");
    lhtkashjax = $.ajax({
        method:"post",
        url:"get_kas_inner.php",
        data:{
            code:code
        },
        dataType:"json",
        error:function(){
            fpl2e();
            errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
        },
        success:function(data){
            var htmlout = "";

            $("#"+id).html("Lihat");

            $("#bkbbtn").fadeOut();
            $("#hydpbtn").fadeOut();
            $("#hydpbtn2").fadeOut();
            $("#hydpbtn3").fadeIn();

            if (data.status == "0") {
                
            } else if (data.status == "1") {
                if (data.kasi == "empty") {
                    htmlout += "<br><br><div style='text-align: center;font-size: 20px;'>Kas Kosong</div><br><br><br>";
                } else {
                    htmlout +=  "<div>" +
                                    "<ol><li>a" +
                                    "</li></ol>" +
                                "</div>";
                }
            }

            htmlout += "<hr class='hr'>";
            htmlout += "<div class='divkasinn-form'><h5 style='text-align: center;'>Tambah Data</h5>";
            htmlout += "<form id='kas_inn_form'>" +
                            "<div class='div-input'><input class='form-input form-control' id='input_ksinn_kepkeg' onKeyup=\"limiter('40', 'input_ksinn_kepkeg', 'textnumbersimplesymbol');\" type='text' name='k_2' placeholder='Keperluan / Kegiatan' ></div> " +
                            "<div class='div-input'><div style='display: inline-block;width: 12%;'>IDR.</div><div style='display: inline-block;width: 88%;'><input class='form-input-wb form-control' type='number' name='pemasukan' placeholder='Pemasukan' ></div></div> " +
                            "<div class='div-input'><div style='display: inline-block;width: 12%;'>IDR.</div><div style='display: inline-block;width: 88%;'><input class='form-input-wb form-control' type='number' name='pengeluaran' placeholder='Pengeluaran' ></div></div> " +
                        "</form>" +
                        "<div style='text-align: right;margin: 2px 4px;'><button onClick='save_kas_inner();' class='btn btn-success'>Tambah</button></div></div>";


            $("#khoutop").fadeOut();
            $("#khout").fadeOut();
            setTimeout(function(){
                $("#divoutput").html(htmlout).fadeIn();
                divbodyin();
                fpl2e();
            }, 500);
        }
    });
}

function save_kas_inner() {
    var data = $("#kas_inn_form").serialize();
    alert(data);
    $.ajax({
        method: "post",
        url: "sav_kas_inn.php",
        data: {
            data: data,
            code: kas_code_use
        },
        dataType: "json",
        success: function () {
            
        }
    });
}

function lhtkash2back(title){
    $(".summernote").summernote("reset");
    var code = kas_code_use;
    var id = kas_id_use;
    enabledelkhbtn();
    divbodyout();
    $("#hydpbtn3").html("<div style='display: inline-block;' class='ld ld-rubber-h'>Loading</div> <a class='ld ld-ring ld-cycle'></a>").prop("disabled", true).fadeOut();
    $("#divoutput").fadeOut().html("");
    $("#divoutput2").fadeOut().html("");
    $("#divoutput2_b").fadeOut().html("");
    $("#divsummernote").fadeOut();
    $('.summernote').summernote('reset');
    setTimeout(function(){
        $("#bkbbtn").fadeIn().prop("disabled", false);
        $("#hydpbtn").fadeIn().prop("disabled", false);
        $("#hydpbtn3").html("Kembali").prop("disabled", false);
        $("#hydpbtn2").fadeIn();
        $("#khout").fadeIn();
        $("#khoutop").fadeIn();
        divbodyin();
    }, 200);
    setTimeout(function(){
        set_last_screen_position();
    }, 300);
    setTimeout(function(){
        if(title == null){
            var title = kas_text_use;
            lhtkash1(code, id, title);
        }else{
            var title = "Data Telah Dihapus";
            setTimeout(function(){
                var td_id = id.replace("blhkh",  "");
                deleted_kas_header(td_id);
            }, 500);
        }
    }, 400);
}

var countseldel = 0;
function selecteddel(){
    fpl2s();
    var kastotal = $("#khout").attr("kastotal");
    var delbtn = $("#khout").attr("idkhdelbtn");
    var lhbtn = $("#khout").attr("idkhlhbtn");
    var statkhdel = $("#khout").attr("statkhdel");
    delchoseselct = null;

    if(statkhdel == 0){
        $("#bartd3_a_"+countseldel).html("<button class='btn btn-success' id='bseldel_a_"+countseldel+"' onClick=\"btnselecteddel('"+countseldel+"')\" attrchecked='0'><img style='height: 15px;' src='../system/icon/delete-white.png' ></button>");
        $("#bartd3_b_"+countseldel).html("<button class='btn btn-success' id='bseldel_b_"+countseldel+"' onClick=\"btnselecteddel('"+countseldel+"')\" attrchecked='0'><img style='height: 15px;' src='../system/icon/delete-white.png' ></button>")
    }else{
        $("#trgkh"+countseldel).removeClass("ld-fall-ttb-in").addClass("ld-float-ltr-out");
    }


    countseldel = countseldel+1;
    if(countseldel == kastotal){
        countseldel = 0;
        fpl2e();
        if(statkhdel == 0){
            $("#khoutop").fadeOut();
            setTimeout(function(){
                $("#hydpbtn").html("Batal").removeClass("btn-danger").addClass("btn-success");
                $("#bkbbtn").css({"font-size":"0rem","opacity":"0","padding":"0rem 0rem"}).prop("disabled", true);

                $("#prevpagebtn").prop("disabled", true);
                $("#nextpagebtn").prop("disabled", true);

                setTimeout(function(){
                    $("#hydpbtn2").css({"font-size":"1rem","opacity":"1","padding":"0.375rem 0.75rem"}).prop("disabled", false);
                }, 500);
            }, 500);
            $("#khout").attr("statkhdel", "1");
        }else{
            $("#khoutop").fadeIn();
            setTimeout(function(){
                $("#hydpbtn2").css({"font-size":"0rem","opacity":"0","padding":"0rem 0rem"}).prop("disabled", true);

                $("#prevpagebtn").prop("disabled", false);
                $("#nextpagebtn").prop("disabled", false);

                setTimeout(function(){
                    $("#bkbbtn").css({"font-size":"1rem","opacity":"1","padding":"0.375rem 0.75rem"}).prop("disabled", false);
                    $("#hydpbtn").removeClass("btn-success").addClass("btn-danger").html("Hapus Yang Dipilih");
                    if(khoutdomori != null){
                        $("#khout").html(khoutdomori);
                    }
                    $("#khout").fadeIn();
                }, 500);
            }, 500);
            $("#khout").attr("statkhdel", "0");
        }
    }else{
        setTimeout(function(){
            selecteddel();
        }, 100);
    }
}

function btnselecteddel(no){
    var checka = $("#bseldel_a_"+no).attr("attrchecked");
    var checkb = $("#bseldel_b_"+no).attr("attrchecked");
    if(checka == checkb){
        if(checka == 0){
            $("#bseldel_a_"+no).attr("attrchecked", "1").removeClass("btn-success").addClass("btn-danger").html("<img style='height: 15px;' src='../system/icon/check-white.png' >");
            $("#bseldel_b_"+no).attr("attrchecked", "1").removeClass("btn-success").addClass("btn-danger").html("<img style='height: 15px;' src='../system/icon/check-white.png' >");
        }else if(checka == 1){
            $("#bseldel_a_"+no).attr("attrchecked", "0").removeClass("btn-danger").addClass("btn-success").html("<img style='height: 15px;' src='../system/icon/delete-white.png' >");
            $("#bseldel_b_"+no).attr("attrchecked", "0").removeClass("btn-danger").addClass("btn-success").html("<img style='height: 15px;' src='../system/icon/delete-white.png' >");
        }
    }else{
        alert("ERROR");
    }
}

var delkasstat = 0;
function delkash(code, id){
    delkasstat = delkasstat+1;
    var statkhdel = $("#khout").attr("statkhdel");
    var checked = $("#"+id).attr("attrchecked");
    if(statkhdel == 0){
        disabledelkhbtn();
        $("#"+id).html("<div style='display: inline-block;' class='ld ld-rubber-h'>Loading</div> <a class='ld ld-ring ld-cycle'></a>");
        $.ajax({
            method:"post",
            url:"del_kas_head.php",
            data:{
                code:code
            },
            dataType:"text",
            error:function(){
                fpl2e();
                errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
            },
            success:function(data){
                enabledelkhbtn();
                get_kas_header();
            }
        });
    }else{
        if(checked == 0){
            $("#"+id).css({"width":"0px","height":"auto","padding":"0.375rem 0px",});
            $("#"+id).attr("attrchecked", "1");
            $("#"+id).removeClass("btn-success").addClass("btn-danger");
            setTimeout(function(){
                $("#"+id).html("<img style='height: 15px;' src='../system/icon/check-white.png' >");
                $("#"+id).css({"width":"auto","height":"auto","padding":"0.375rem 0.75rem",});
            }, 300);
        }else{
            $("#"+id).css({"width":"0px","height":"auto","padding":"0.375rem 0px",});
            $("#"+id).attr("attrchecked", "0");
            $("#"+id).removeClass("btn-danger").addClass("btn-success");
            setTimeout(function(){
                $("#"+id).html("<img style='height: 15px;' src='../system/icon/check-white.png' >");
                $("#"+id).html("<img style='height: 15px;' src='../system/icon/delete-white.png' >");
                $("#"+id).css({"width":"auto","height":"auto","padding":"0.375rem 0.75rem",});
            }, 300);
        }
    }
}

function disabledelkhbtn(){
    var kastotal = $("#khout").attr("kastotal");
    var delbtn = $("#khout").attr("idkhdelbtn");
    var lhbtn = $("#khout").attr("idkhlhbtn");
    $("#"+delbtn+countseldel).prop("disabled", true);
    $("#"+lhbtn+countseldel).prop("disabled", true);
    countseldel = countseldel+1;
    if(countseldel == kastotal){
        $("#hydpbtn").prop("disabled", true);
        $("#bkbbtn").prop("disabled", true);
        countseldel = 0;
    }else{
        disabledelkhbtn();
    }
}
function enabledelkhbtn(){
    var kastotal = $("#khout").attr("kastotal");
    var delbtn = $("#khout").attr("idkhdelbtn");
    var lhbtn = $("#khout").attr("idkhlhbtn");
    $("#"+delbtn+countseldel).prop("disabled", false);
    $("#"+lhbtn+countseldel).prop("disabled", false);
    countseldel = countseldel+1;
    if(countseldel == kastotal){
        $("#hydpbtn").prop("disabled", false);
        $("#bkbbtn").prop("disabled", false);
        countseldel = 0;
    }else{
        enabledelkhbtn();
    }
}

var delchoseselct = null;
var confirmdelchoseselct = null;
var seldconc = 1;
var coseldconc = 0;
function selecteddelcon(){
    confirmdelchoseselct = null;
    var kastotal = $("#khout").attr("kastotal");
    var checka = $("#bseldel_a_"+seldconc).attr("attrchecked");
    var checkb = $("#bseldel_b_"+seldconc).attr("attrchecked");
    if(checka == checkb){
        if(checka == 1){
            if(delchoseselct == null){
                delchoseselct = $("#trgkh"+seldconc).attr("attrkcod");
            }else{
                delchoseselct = delchoseselct+"#"+$("#trgkh"+seldconc).attr("attrkcod");
            }
            coseldconc = coseldconc+1;
        }   
    }
    if(seldconc == kastotal+1){
        confirmdelchoseselct = delchoseselct;
        if(coseldconc == 0){
            
        }else{
            form1op("Konfirmasi!", "Yakin, Anda Akan Menghapus "+coseldconc+" data, data yang sudah terhapus tidak bisa dikembalikan lagi!", "<button class='btn btn-success' onclick='form1cl();'>Batal</button> <button class='btn btn-danger' onclick=\"selecteddelconfirm();$(this).prop('disabled', true).html('Loading...')\">Ya</button>")
        }
        seldconc = 0;
        coseldconc = 0;
        delchoseselct= null;
    }else{
        seldconc = seldconc+1;
        selecteddelcon();
    }
}
function selecteddelconfirm(){
    $.ajax({
        method:"post",
        url:"seldel_kas_head.php",
        data:{list:confirmdelchoseselct},
        dataType:"json",
        error:function(){
            fpl2e();
            errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
        },
        success:function(data){
            if(data.status === "error"){
                alert("ERROR");
            }else{
                selecteddel();
                get_kas_header();
                setTimeout(function(){
                    form1cl();
                }, 2000);
            }
        }
    });
}


function edkht(title, c, id){
    form1opanim("",
                "Nama Kas : <input class='form form-control' id='bniksh2' onKeyup=\"if($(this).val() != '"+title+"'){ $('#btn_bniksh2').prop('disabled', false); }else{ $('#btn_bniksh2').prop('disabled', true); }limiter('40', 'bniksh2', 'textnumbersimplesymbol');\" type='text' onkeyup=\"limiter('40', 'bniksh2', 'textnumbersimplesymbol');\" value='"+title+"'>",
                "<button onclick=\"edkhtb('"+c+"', '"+id+"');blosel(this);\" class='btn btn-danger'>Batal</button> <button id='btn_bniksh2' onClick=\"edkhta('"+title+"', '"+c+"', '"+id+"');\" class='btn btn-success' disabled>Ubah</button>",
                "ld-grow-ttb-in", "ld-grow-ttb-out");
}
function edkhta(title, c, id){
    var td_id = id;
    td_id = td_id.replace("blhkh", "");

    $("#btn_bniksh2").prop("disabled", true).html("Loading <div class='ld ld-ring ld-cycle'></div>");
    var new_title = $("#bniksh2").val();
    if(title != new_title){
        $.ajax({
            method:"post",
            url:"c_kas_title.php",
            data:{
                title:new_title,
                code:c
            },
            dataType:"json",
            error:function(){
                fpl2e();
                errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
            },
            success:function(data){
                if(data.status == 0){
                    deleted_kas_header(td_id);
                }else{
                    edkhtb(c, td_id, new_title);
                }
            }
        });
    }
}
function edkhtb(c, id, title){
    if(title == null){
        lhtkash1(c, id);
    }else{
        $("#tdblhkh"+id).html(title);
        setTimeout(function(){
            lhtkash1(c, id, title);
        }, 400);
        khoutdomori = $("#khout").html();
    }
}
function blosel(item){
    $(item).html("Loading <div class='ld ld-ring ld-cycle'></div>");
}

function deleted_kas_header(td_id){
    $("#tdblhkh"+td_id).html("Data Telah Dihapus Oleh Pengguna Lain");
    $("#bartd3_a_"+td_id+" button").each(function(){
        $(this).prop("disabled", true);
    });
    $("#bartd3_b_"+td_id+" button").each(function(){
        $(this).prop("disabled", true);
    });
    $("#bartd3_a_"+td_id).attr("id", "disable");
    form1op("", "Tampaknya Data Telah Dihapus Oleh Pengguna Lain", "");
    khoutdomori = $("#khout").html();
}

function get_kas_cat(code){
    divbodyout();
    summernote_text_save = null;
    fpl2s();
    $.ajax({
        method:"post",
        data:{code:code},
        url:"get_kas_cat.php",
        dataType:"json",
        error:function(){
            fpl2e();
            errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
        },
        success:function(data){
            var html = "";

            if(data.status == 0){
                deleted_kas_header(code);
            }else if(data.status == 1){
                divbodyout();
                disabledelkhbtn();
                form1cl();
                $("#khoutop").fadeOut();
                $("#khout").fadeOut();

                $("#bkbbtn").fadeOut();
                $("#hydpbtn").fadeOut();
                $("#hydpbtn2").fadeOut();
                $("#hydpbtn3").fadeIn();

                html += "";
                var catatan_kas = "<div>"+data.catatan+"</div>";
                var button = data.button;
                var kas_stat = null;
                if(data.catatan[0] == null){
                    catatan_kas ="<div>Catatan Kas Kosong</div>";
                }else{
                    summernote_text_save = catatan_kas;
                }
                $("#divoutput2").attr("cod", code).html(catatan_kas);

                $("#divoutput2 a").each(function(){
                    var link = $(this).attr("href");
                    /* required-change ( /myrt000webhost/ ) <- delete this when you upload it */
                    $(this).replaceWith($("<a onClick=\"redirect_link('"+link+"');\" link='http://"+window.top.location.hostname+"/myrt000webhost/link/#"+link+"' href='#'>"+this.innerHTML+"</a>"));
                });
                
                setTimeout(function(){
                    $("#divoutput2_b").html(button).fadeIn();
                    $("#divoutput2").fadeIn();
                    divbodyin();
                    fpl2e();
                }, 500);
            }
        }
    });
}
function kas_cat_summernote(){
    $(".summernote").summernote("reset");
    if(summernote_text_save != null){
        while(summernote_text_save.startsWith('<div>')){
        summernote_text_save = summernote_text_save.replace('<div>', '');
        }
        while(summernote_text_save.endsWith('</div>')){
            summernote_text_save = summernote_text_save.replace(new RegExp('</div>$'), '');
        }
    }

    $("#divoutput2").fadeOut();
    if(summernote_text_save == null){
        summernote_text_save = null;
        $('.summernote').summernote('insertText', "");
    }else{
        $('.summernote').summernote('code', summernote_text_save);
    }
    setTimeout(function(){
        $("#divsummernote").fadeIn();
    }, 700);
}

$('.summernote').on('summernote.change', function(we, contents, $editable) {
    console.log('summernote\'s content is changed.');
});
function save_catatan_kas(){
    var code = $("#divoutput2").attr("cod");
    var text = $(".summernote").summernote("code");
    while(text.startsWith('<div>')){
        text = text.replace('<div>','');
    }
    while(text.endsWith('</div>')){
        text = text.replace(new RegExp('</div>$'),'');
    }
    text = text.replace('<div>', "");

    if(summernote_text_save != null){
        while(summernote_text_save.startsWith('<div>')){
        summernote_text_save = summernote_text_save.replace('<div>', '');
        }
        while(summernote_text_save.endsWith('</div>')){
            summernote_text_save = summernote_text_save.replace(new RegExp('</div>$'), '');
        }
    }
    if(text != summernote_text_save){
        fpl2s();
        if(text != null){
            $.ajax({
                method:"post",
                url:"sav_kas_cat.php",
                data:{
                    text:text,
                    code:code
                },
                dataType:"json",
                error:function(){
                    fpl2e();
                    errordiv1s("ERROR", "Maaf Tampaknya Telah Terjadi Kesalahan", "0", "error");
                },
                success:function(data){

                    if(data.status == "0"){
                        fpl2e();
                        lhtkash2back("0");
                    }else if(data.status == "1"){
                        $(".summernote").summernote("reset");
                        summernote_text_save = text;
                        $("#divsummernote").fadeOut();
                        setTimeout(function(){
                            get_kas_cat(code);
                        }, 500);
                    }
                }
            });
        }
    }else{
        $(".summernote").summernote("reset");
        summernote_text_save = text;
        $("#divsummernote").fadeOut();
        get_kas_cat(code);
    }
}