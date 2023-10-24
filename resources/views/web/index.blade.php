<x-template>
  <x-navbar/>

  <x-container>
    <div class="group-search">
      <svg class="icon-search" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
      <input placeholder="Pencarian" type="search" class="input input-search">
    </div>
  </x-container>

  <x-hero/>

  <x-container>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="containerPaket"></div>
    <div class="w-full text-center" id="loading">Loading...</div>
  </x-container>

  <x-footer class="mt-8"/>

</x-template>

<script>
  $.ajax({
    type: "get",
    url: "{{ url('api/v1/tailor') }}",
    dataType: "json",
    success: function(response) {
      $(document).ready(function() {
        // empty container element
        $("#loading").addClass('hidden')
        $("#containerPaket").empty();

        $.each(response.data, function(index, item) {
          const html = /*html*/`
            <x-card-paket
              src="uploads/tailor/${item.tailor_img}"
              profile="uploads/tailor/${item.tailor_img}"
              name="${item.tailor_name}"
              title="${item.description}"
              price="0"
            />
          `

          // add element to container
          $("#containerPaket").append(html);
        });
      });

    },
    error: function() {
      console.log("Failed to get data from the server");
    }
  });
</script>