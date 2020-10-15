<!-- Vendor -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>

<!-- Ventana Modal -->
<script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>
<script src="{{ asset('assets/js/pages/forms/form-wizard.js') }}"></script>

<!-- Ventana Modal -->
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<!--<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>-->
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<!-- Ventana Modal -->
<script src="{{ asset('assets/vendor/dropify/js/dropify.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-steps/jquery.steps.js') }}"></script>

<!-- JQuery Steps Plugin Js -->

<!-- Datepicker -->
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!--multi select-->
<script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<!-- Multi Select Plugin Js -->
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('assets/select2/select2.full.js') }}"></script>
<script src="{{ asset('assets/select2/select2-form.js') }}"></script>
<!-- Tags -->
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/js/parsley.js') }}"></script>

<script type="text/javascript">
//  $('#asco').hide();
$(document).ready(function() {

$('select[name="planes"]').on('change', function(){
var tipo = document.getElementById('tipo').value;
 var plan = $(this).val();
 if(plan) {
     $.ajax({

         url: '/variables/get/'+plan+'/'+tipo,
         type:"GET",
         dataType:"json",
         beforeSend: function(){
             $('#loader').css("visibility", "visible");
         },

         success:function(data) {
             $('#acciones').show();
             $('select[name="accion_id"]').empty();
             $('select[name="accion_id"]').append('<option value="0">Seleccionar</option>');
             $.each(data, function(key, value){

                 $('select[name="accion_id"]').append('<option value="'+ key +'">' + value + '</option>');

             });
         },
         complete: function(){
             $('#loader').css("visibility", "hidden");
         }
     });
 } else {
     $('select[name="accion_id"]').empty();

 }

});

});
</script>

<script type="text/javascript">
$('#multiselect4-filter').multiselect({
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      maxHeight: 200
  });
  $('#multiselect1, #multiselect2, #single-selection, #multiselect5, #multiselect6').multiselect({
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    maxHeight: 300
   });
</script>
<script type="text/javascript">

$(document).ready(function(){

    $('#categorias').on('change', function() {

      if ( this.value == '9')

      {

        $("#tiempo").show();

      }

      else

      {

        $("#tiempo").hide();

      }

      if ( this.value == '6')

      {

        $("#suma").show();

      }

      else

      {

        $("#suma").hide();

      }

      if ( this.value == '7')

      {

        $("#porcentajea").show();

      }

      else

      {

        $("#porcentajea").hide();

      }

      if ( this.value == '10')

      {

        $("#seleccionar").show();

      }

      else

      {

        $("#seleccionar").hide();

      }

    });

});

</script>
<script type="text/javascript">
function confirmarBorrado() {
    return confirm('¿Estas seguro de borrar?');
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'excelHtml5'},
            { extend: 'copyHtml5'}
        ]
    } );
} );
</script>
<script src="{{ asset('assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js') }}"></script>
<script>
    $(function() {
        $('#progress-format1 .progress-bar').progressbar({
            display_text: 'fill'
        });

        $('#progress-format2 .progress-bar').progressbar({
            display_text: 'fill',
            use_percentage: false
        });

        $('#progress-custom-format .progress-bar').progressbar({
            display_text: 'fill',
            use_percentage: false,
            amount_format: function(p, t) {
                return p + ' of ' + t;
            }
        });

        $('#progress-striped .progress-bar, #progress-striped-active .progress-bar, #progress-stacked .progress-bar').progressbar({
            display_text: 'fill'
        });

        $('.progress.vertical .progress-bar').progressbar();
        $('.progress.vertical.wide .progress-bar').progressbar({
            display_text: 'fill'
        });
    });
</script>
<script>
$('#select-country').selectize();
</script>
