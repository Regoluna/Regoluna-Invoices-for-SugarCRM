$( document ).ready(function() {

  var originalList = {};
  var dropdown = document.getElementById('state');

  $('select#state option').each( function(){
    originalList[ $(this).val() ] = $(this).attr('label');
  });

  adjustStateSelector();
  $('select#reg_invoices_type').bind('change', adjustStateSelector );

  function adjustStateSelector(){
    var type = $('#reg_invoices_type').val();
    var currentSelection = $('select#state').val();
    var i, opt;

    for(i=0; i<dropdown.children.length; i++){
      dropdown.remove( i );
    }

    while( dropdown.children.length ) dropdown.remove( 0 );

    for( i in originalList ){

      if( i.indexOf( type ) === 0){
        opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = originalList[i];
        if( i === currentSelection ) opt.selected=true;
        dropdown.appendChild(opt);
      }

    }

  }

  // Fix bug with 'prefix' field
  removeFromValidate('EditView','prefix');

});
