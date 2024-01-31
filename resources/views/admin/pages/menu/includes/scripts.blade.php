@section('scripts')

  <script>
    var items = document.getElementById('items');
    var sortable = Sortable.create(items, {
      handle: '.glyphicon-move',
      animation: 150
    });
  </script>

  <script>
    function confirmDeleteMenu(formId) {
      swal({
        title: 'آیا مطمئن هستید؟',
        text: 'بعد از حذف این آیتم دیگر قابل بازیابی نخواهد بود!',
        icon: 'warning',
        buttons: ["انصراف", "حذف کن"],
        dangerMode: true
      })
      .then((willDelete) => {
        if (willDelete) {
          document.getElementById(formId).submit();
          swal('آیتم با موفقیت حذف شد.', {
            icon: 'success',
          });
        }
      });
    }
  </script>

  <script>
    function toggleInput(){
      let selectOption = document.getElementById('linkableType');
      let linkableIdSelectOption = document.getElementById('linkableId');
      let linkInput = document.getElementById('link');
      if (selectOption.value === "self_link") {
        linkInput.disabled = false;
        linkableIdSelectOption.disabled = true;
        linkableIdSelectOption.value = "none";
      }else if (selectOption.value === 'none'){
        linkInput.disabled = true;
        linkInput.value = null;
        linkableIdSelectOption.disabled = true;
        linkableIdSelectOption.value = "none";
      }else{
        linkInput.disabled = true;
        linkInput.value = null;
        linkableIdSelectOption.disabled = false;
      }
    }
  </script>

  <script>
    function toggleEditInput(menuItem) {
      let selectOption = document.getElementById(`linkableTypeEdit-${menuItem.id}`);
      let linkableIdSelectOption = document.getElementById(`linkableIdEdit-${menuItem.id}`);
      let linkInput = document.getElementById(`linkEdit-${menuItem.id}`);
      if (selectOption.value === "self_link" ) {
        linkInput.disabled = false;
        linkInput.value = menuItem.link;
        linkableIdSelectOption.disabled = true;
        linkableIdSelectOption.value = "none";
      }else {
        linkInput.value = null;
        linkInput.disabled = true;
        linkableIdSelectOption.disabled = false;
        if (menuItem.linkable_id === null) {
          linkableIdSelectOption.options["none"].setAttribute('selected', 'selected');
        }
        linkableIdSelectOption.value = menuItem.linkable_id;
      }
    }
  </script>

@endsection