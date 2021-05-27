<x-app-layout>

  <div class="flex justify-center mt-10">
      <div class="w-8/12 p-6 rouded-lg">
          <div class="flex flex-nowrap ml-10 ">
              <div class="inline-block">
                  <div class=" px-8 py-8 bg-white rounded-lg shadow-md bg-white">

                    @if(!isset($u))
                      <div class="flex justify-start p-6">
                          <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Winning Number</a>
                      </div>
                    @endif
                      @if($errors->any())
                          <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                            <p class="font-bold">There are some errors.</p>
                            <ul>
                                @foreach($errors->all() as $error)
                                  <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                          </div>                            
                      @endif
                      <!-- This example requires Tailwind CSS v2.0+ -->
                      <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                              <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                  <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Winning Number 1
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Winning Number 2
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Winning Number 3
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Winning Number 4
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Winning Number 5
                                    </th>
                                  </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                  @foreach($users as $user)
                                  <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      <div class="flex items-center">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900 text-center">
                                            {{ $user->name }}
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                          <div class="text-sm-center font-medium text-gray-900 text-center">
                                            {{ $user->winning_number1 }}
                                          </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900 text-center">
                                            {{ $user->winning_number2 }}
                                          </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900 text-center">
                                            {{ $user->winning_number3 }}
                                          </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900 text-center">
                                            {{ $user->winning_number4 }}
                                          </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900 text-center">
                                            {{ $user->winning_number5 }}
                                          </div>
                                        </div>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>