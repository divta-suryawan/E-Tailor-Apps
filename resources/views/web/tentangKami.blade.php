<x-template>
  <x-navbar/>
  <x-hero/>

  <x-container>
    <div class="flex flex-row justify-evenly gap-2">
      <x-point icon="fa-briefcase" text="Penjahit berpengalaman" />
      <x-point icon="fa-award" text="Kualitas terjamin" />
      <x-point icon="fa-face-smile-beam" text="Layanan yang ramah" />
    </div>
  </x-container>

  <x-container>
    <div class="flex flex-col-reverse sm:flex-row my-8">
      <div class="w-full sm:w-3/6 flex justify-center">
        <img src="{{ asset('assets/images/people-2.svg') }}" alt="" class="w-1/2">
      </div>
      <p class="w-full text-center sm:w-3/6 md:text-lg flex items-center pb-8">
        Tempat di mana kebutuhan pakaian Anda bertemu dengan kreativitas para ahli jahit. Kami adalah wadah yang menghubungkan Anda dengan beragam penyedia jasa jahit terpercaya, yang siap mewujudkan desain pakaian impian Anda. Di sini, kami memahami bahwa setiap jahitan memiliki cerita uniknya sendiri, dan itulah yang membedakan kami. Dengan beragam kemampuan dan pengalaman, para penyedia jasa jahit kami siap memberikan pelayanan berkualitas tinggi sesuai dengan keinginan Anda.
      </p>
    </div>
  </x-container>

  <x-container>
    <div class="text-2xl font-bold mb-4">Tim kami</div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2">
      <x-card-team image="baju-jahit-2.jpeg" name="fandi ahmad" position="web designer"/>
      <x-card-team image="baju-jahit-2.jpeg" name="muhammad rizki" position="backend developer"/>
      <x-card-team image="baju-jahit-2.jpeg" name="i ketut divta suryawan" position="backend developer"/>
      <x-card-team image="baju-jahit-2.jpeg" name="alan rizki" position="backend developer"/>
      <x-card-team image="baju-jahit-2.jpeg" name="siti rahayu" position="backend developer"/>
    </div>
  </x-container>

  <x-container class="my-8 grid grid-cols-1 sm:grid-cols-2 gap-32">
    <x-contact/>
    <div class="hidden sm:flex items-center justify-center">
      <img src="{{ asset('assets/images/send-message.svg') }}" alt="" class="w-2/3">
    </div>
  </x-container>

  <x-footer/>

</x-template>