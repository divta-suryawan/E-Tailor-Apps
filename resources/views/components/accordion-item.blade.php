<div class="accordion-item border-b border-gray-200">
  <button class="accordion-button flex justify-between items-center w-full p-4 transition duration-100">
    <span class="font-semibold text-start">{{ $question ?? '' }}</span>
    <svg class="w-4 h-4 transform rotate-180 {{ $active ?? 'rotate-0' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
  </button>
  <div class="accordion-content {{ $active ?? 'hidden' }} p-4">
    <p>{{ $answer ?? '' }}</p>
  </div>
</div>