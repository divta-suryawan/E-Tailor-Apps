<x-template>
  <x-navbar/>
  <x-hero/>

  <x-container>
    <div class="flex flex-row justify-evenly gap-2">
      <x-point icon="fa-house" text="Penjahit berpengalaman" />
      <x-point icon="fa-house" text="Kualitas terjamin" />
      <x-point icon="fa-smile" text="Layanan yang ramah" />
    </div>
  </x-container>

  <x-container>
    <div class="flex flex-col-reverse sm:flex-row my-8">
      <div class="w-full sm:w-3/6 flex justify-center">
        <img src="{{ asset('assets/images/people-2.svg') }}" alt="" class="w-1/2">
      </div>
      <p class="w-full text-center sm:w-3/6 md:text-lg flex items-center pb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur nobis architecto quibusdam veritatis quod. Dolorem placeat obcaecati tempore, reprehenderit tempora libero quia eum molestiae? Ut eligendi et, id repellat repudiandae reiciendis doloremque quae modi quibusdam labore ullam sit ipsum. Vitae maiores quia omnis velit vel libero nulla, ipsum, ratione eaque non quod in officia necessitatibus! Corporis consectetur molestiae eveniet iusto.</p>
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

  <x-container class="my-8">
    <x-contact/>
  </x-container>

  <x-footer/>

</x-template>