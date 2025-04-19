<x-Pregnant-layout>
   <div class="relative flex flex-col items-center justify-center w-full h-screen p-6 bg-white rounded-lg shadow-lg overflow-hidden">
       <!-- Heading -->
       <div class="flex items-center mb-6 z-10">
           <i class='bx bx-baby-carriage text-4xl icon-colored mr-3'></i>
           <h1 class="text-3xl font-bold text-gray-800">Welcome to the Pregnant Section</h1>
       </div>

       <!-- Image with overlay -->
       <div class="relative w-full h-full rounded-lg shadow-lg overflow-hidden">
           <img src="{{ asset('images/pregnant.jpg') }}" alt="Breastfeeding Woman" class="w-full h-full object-cover" />
           <div class="absolute inset-0 bg-black bg-opacity-50"></div>

           <!-- Sliding Text -->
           <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white text-4xl font-semibold z-10 opacity-0 transition-opacity duration-1000" id="slidingText">
               <i class='bx bx-heart-circle icon-colored mr-2'></i> Healthy mothers, healthy babies.
           </div>
       </div>
   </div>

   <style>
       .icon-colored {
           color: #FE6700;
       }
       .transition {
           transition: all 0.3s ease;
       }
       .shadow-lg {
           box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
       }
   </style>

   <script>
       const messages = [
           "<i class='bx bx-heart-circle icon-colored mr-2'></i> Healthy mothers, healthy babies.",
           "<i class='bx bx-baby icon-colored mr-2'></i> Breastfeeding supports baby's growth and immunity.",
           "<i class='bx bx-first-aid icon-colored mr-2'></i> Prenatal care ensures a safe pregnancy.",
           "<i class='bx bx-water icon-colored mr-2'></i> Stay nourished and hydrated, mom!",
           "<i class='bx bx-calendar-check icon-colored mr-2'></i> Regular checkups are key to healthy delivery."
       ];

       let index = 0;
       const slidingText = document.getElementById('slidingText');

       setInterval(() => {
           slidingText.classList.remove('opacity-100');
           slidingText.classList.add('opacity-0');

           setTimeout(() => {
               index = (index + 1) % messages.length;
               slidingText.innerHTML = messages[index];
               slidingText.classList.remove('opacity-0');
               slidingText.classList.add('opacity-100');
           }, 1000);
       }, 5000);
   </script>
</x-Pregnant-layout>
