@props(['trigger'])
<div x-data="{ show: false }" @click.away="show=false">
    <!-- Trigger  -->
    <div @click="show = !show">

        <button
            class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex"
            >

            {{isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}

            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />

        </button>
    </div>

            <!-- Links -->
            <div x-show="show" class = "py-2 absolute bg-gray-100 mt-2 rounded-xl w-full z-50 overflow-auto max-h-52" style="display:none">

                {{$slot}}

                <!-- <a href="#" class="block text-left px-3 text-sm leading-6 hover:bg-blue-300 focus:bg-blue-300 hover:text-white focus:text-white">Two</a>
                <a href="#" class="block text-left px-3 text-sm leading-6 hover:bg-blue-300 focus:bg-blue-300 hover:text-white focus:text-white">Three</a>
                <a href="#" class="block text-left px-3 text-sm leading-6 hover:bg-blue-300 focus:bg-blue-300 hover:text-white focus:text-white">A Longer Link</a> -->
            </div>
    </div>
