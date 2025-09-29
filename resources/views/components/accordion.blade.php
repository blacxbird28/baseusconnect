@props(['titleAccordion', 'contentAccordion', 'number', 'delay'])

<div class="relative mb-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{$delay}}s">
  <button
    class="relative w-full text-[16px] md:text-[18px] font-bold text-left transition-all ease-in cursor-pointer bg-primary-white text-primary-black rounded-lg group
    lg:text-[20px]"
    data-collapse-target="collapse-{{$number}}"
  >
    <span class="block w-full py-[10px] px-[20px] border-t border-r border-l border-b border-solid border-primary-black rounded-lg overflow-hidden
      group-open:rounded-bl-none
      group-open:rounded-br-none
      group-open:font-normal
      group-open:bg-primary-yellow">{{$titleAccordion}}</span>

    <div class="accordion__icons absolute top-[15px] right-[10px]">
      <img src="{{asset('/images/icon-down.png')}}" alt="" class="relative w-[20px] top-0 md:top-[11px] transition duration-300
        group-open:rotate-180
        lg:top-0
        lg:w-full">
    </div>

    <div
      data-collapse="collapse-{{$number}}"
      class="accordion__content h-0 overflow-hidden transition-all duration-300 ease-in-out border-r border-l border-solid border-primary-black rounded-bl-lg rounded-br-lg
      group-open:border-b-[1px]"
    >
      <div class="py-[10px] px-[20px] text-[16px] md:text-[18px] text-primary-black">
        {!! html_entity_decode($contentAccordion) !!}
      </div>
    </div>
  </button>
</div>
