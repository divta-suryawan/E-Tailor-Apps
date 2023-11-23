<div class="bg-gray-100 drop-shadow-md rounded-md h-full flex flex-col {{ $class ?? '' }}">
  <img src="{{$src ?? 'https://i.pinimg.com/originals/48/5f/a3/485fa3ee064e7cbb30786c3b2c05dc1c.jpg'}}" alt="paket" class="h-28 sm:h-32 md:h-48 w-full object-cover rounded-t-md">
  
  <div class="flex flex-row gap-2 items-center p-2">
    <img src="{{ $profile ?? 'https://static.independent.co.uk/s3fs-public/thumbnails/image/2015/06/06/15/Chris-Pratt.jpg' }}" alt="profile" class="rounded-full w-10 h-10 object-cover">
    <div class="text-lg font-semibold">{{ $name ?? '-' }}</div>
  </div>

  <div class="p-2 flex flex-col items-stretch h-full">
    <div class="title mb-8">{{$title ?? '-'}}</div>
    <div class="font-bold text-lg h-full flex items-end">Mulai dari Rp. {{$price ?? '0'}}</div>
  </div>
  
</div>
