<x-app-layout>

  <div class="flex justify-center mt-10">
      <div class="w-8/12 p-6 rouded-lg">
          <div class="flex flex-nowrap justify-center ml-10 ">
              <div class="inline-block">

                  <div class=" px-8 py-8 bg-white rounded-lg shadow-md bg-white">
                    <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                      <p class="font-semibold text-gray-800">Add new user</p>
                    </div>

                    <form method="POST" action="{{ route('users.store') }}">
                    	@csrf
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	                    <div class="flex flex-col px-6 py-5 bg-gray-50">
	                      <div class="mb-4">
	                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
	                          Name
	                        </label>
	                        <input class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Name">
	                      </div>

	                      <div class="grid grid-cols-2 gap-4">
	                      	<div class="mb-4">
	                      	  <label class="block text-gray-700 text-sm font-bold mb-2" for="winning_number1">
	                      	    Winning Number 1
	                      	  </label>
	                      	  <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="winning_number1" name="winning_number1" type="text" placeholder="Winning Number 1">
	                      	</div>
	                      	<div class="mb-4">
	                      	  <label class="block text-gray-700 text-sm font-bold mb-2" for="winning_number2">
	                      	    Winning Number 2
	                      	  </label>
	                      	  <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="winning_number2" name="winning_number2" type="text" placeholder="Winning Number 2">
	                      	</div>
	                      	<div class="mb-4">
	                      	  <label class="block text-gray-700 text-sm font-bold mb-2" for="winning_number4">
	                      	    Winning Number 3
	                      	  </label>
	                      	  <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="winning_number3" name="winning_number3" type="text" placeholder="Winning Number 3">
	                      	</div>
	                      	<div class="mb-4">
	                      	  <label class="block text-gray-700 text-sm font-bold mb-2" for="winning_number4">
	                      	    Winning Number 4
	                      	  </label>
	                      	  <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="winning_number4" name="winning_number4" type="text" placeholder="Winning Number 4">
	                      	</div>
	                      	<div class="mb-4">
	                      	  <label class="block text-gray-700 text-sm font-bold mb-2" for="winning_number5">
	                      	    Winning Number 5
	                      	  </label>
	                      	  <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="winning_number5" name="winning_number5" type="text" placeholder="Winning Number 5">
	                      	</div>
	                      </div>
						</div>

						<div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
						  <p class="font-semibold text-gray-600">Cancel</p>
						  <button type="submit" class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
						    Save
						  </button>
						</div>

                    </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>