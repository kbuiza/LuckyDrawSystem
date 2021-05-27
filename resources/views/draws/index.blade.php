<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="flex justify-between w-10/12 p-10 ">
            <div class="w-4/12 p-10 rouded-lg bg-white shadow-md rounded-lg">
                <h2 class="flex justify-center text-4xl font-bold">Lucky Draw</h2>
                <div class="flex justify-center">
                    <div class="grid grid-cols-1">
                        <form id="form_luck_draw" action="{{ route('draws.store') }}" method="POST">
                            
                       
                            @csrf

                                <div id="response-parent" hidden class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4"  role="alert">
                                   <ul id="response" ></ul>
                                </div>
                           @if(isset($error1))
                               <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                 <p class="font-bold">There are some errors.</p>
                                 <ul>
                                       <li> {{ $error1 }} </li>
                                 </ul>
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
                            <input id="hdn-token" class="hdn-token" type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="mt-5">
                                <h3>Prize Types</h3>
                                <select onchange="prize_types_change()" id="prize_types" name="prize_types" class="w-full focus:ring-indigo-500 focus:border-indigo-500 bg-transparent text-gray-500 sm:text-sm rounded-md">
                                  <option class="text-gray-400" disabled selected>Select Prize Type</option>
                                  <option @if($grand_prize != 0) echo hidden class="text-gray-400" @endif>Grand Prize</option>
                                  <option @if($second_prize1st != 0) echo hidden class="text-gray-400" @endif>Second Prize - 1st Winner</option>
                                  <option @if($second_prize2nd != 0) echo hidden class="text-gray-400" @endif>Second Prize - 2nd Winner</option>
                                  <option @if($third_prize1st != 0) echo hidden class="text-gray-400" @endif>Third Prize - 1st Winner</option>
                                  <option @if($third_prize2nd != 0) echo hidden class="text-gray-400" @endif>Third Prize - 2nd Winner</option>
                                  <option @if($third_prize3rd != 0) echo hidden class="text-gray-400" @endif>Third Prize - 3rd Winner</option>
                                </select>
                            </div>
                            <div class="mt-5">
                                <h3>Generate Randomly</h3>
                                <select onchange="generate_randomly()" id="generate" name="generate" class="w-full focus:ring-indigo-500 focus:border-indigo-500 bg-transparent text-gray-500 sm:text-sm rounded-md">
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                            </div>
                            <div class="mt-5">
                                <h3>Winning Number</h3>
                                <input type="text" name="winning_number" id="winning_number" class="w-full focus:ring-indigo-500 focus:border-indigo-500 bg-transparent text-gray-500 sm:text-sm rounded-md">
                            </div>
                            <div class="mt-10">

                                <button type="submit" id="btn_draw" class="modal-open w-full px-4 py-2 text-white font-semibold bg-blue-500 rounded sm:text-sm rounded-md">
                                    Draw
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Modal-->
            <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
              <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
              
              <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                


                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                  <!--Title-->
                  <div class="flex justify-between items-center pb-3">
                    <p class="text-4xl font-bold">Congratulations!</p>
                  </div>

                  <!--Body-->
                  <div class="grid grid-cols-2 py-5 px-5 w-full">
                    <div class="w-8/12">
                        <p>Winner: </p> <h2 class="w_name text-xl font-bold">@if(isset($new_winner)) {{$new_winner}} @endif</h2>
                    </div>
                    <div>
                      <p>Winning Number: </p> <h2 class="w_number text-3xl font-bold "></h2>
                    </div>
                  </div>

                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2 py-4 text-left px-6 bg-gray-100 mt-2">
                  <button type="button" class="btn_ok px-8 bg-blue-500 p-2 rounded-lg text-white hover:bg-blue-400">OK</button>
                </div>

              </div>
            </div>


            <div class="w-7/12 p-10 rouded-lg bg-white shadow-md rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <h2 class="flex justify-center text-4xl font-bold mb-5">Winners</h2>
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
                                Prize Type
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Winning Number
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($winners as $winner)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                  <div class="">
                                    <div class="text-sm font-medium text-gray-900">
                                      {{ $winner->name }}
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <div class="">
                                    <div class="text-sm-center font-medium text-gray-900">
                                      {{ $winner->prize_type }}
                                    </div>
                                  </div>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <div class="">
                                    <div class="text-sm font-medium text-gray-900">
                                      {{ $winner->winning_number }}
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

  

    <script type="text/javascript">

        $( document ).ready(function() {

            // $('#form_luck_draw').on('submit', function(e) { 

            //     // e.preventDefault();
            //     // toggleModal();

            // });

            $('#form_luck_draw').on('submit', function(e){
                e.preventDefault()
                $('#response').children().remove();
               var url = e.target.action  // get the target
               var formData = $(this).serialize() // get form data
               var token = $('#hdn-token').val();
               var prize_types = $('#prize_types').val();
               var generate = $('#generate').val();
               var winning_number = $('#winning_number').val();
               // console.log(formData);

               // data = { 
               //             _token: token,
                          
               //         };

               // $.post(url, formData, function (response) { // send; response.data will be what is returned
               //  console.log(response.name)
               //     $('.w_name').text(response.name);
               //     $('.w_number').text(response.new_winner);
               //     toggleModal();

               // })


               $.post(url, formData).done(function (response) {
                console.log(response.name)
                   $('.w_name').text(response.name);
                   $('.w_number').text(response.new_winner);
                   toggleModal();
               })
               .fail(function(xhr, status, error){
                var errors = $.parseJSON(xhr.responseText);

                $.each(errors, function(key, value){

                    if($.isPlainObject(value)) {
                        $.each(value, function (key, value) {                       
                        
                        $('#response-parent').show();
                        $('#response').append("<li>" + value + "</li>");

                        });
                    }else{
                        // $('#response').append("<li>" + value + "</li>");
                    }

                })
                    console.log(xhr.responseText);
               });
               // $.ajax({
               //         url: '/draws/',
               //         type: "POST",
               //         data: data,
               //         success: function( response ) {

               //          $(window).load(function(){
               //              $('.w_name').text(response.name);
               //              $('.w_number').text(response.new_winner);
               //              toggleModal();
               //          });
               //          // toggleModal();
               //          //  e.preventDefault();
               //          // console.log(response.name);

                        
               //         },
                      
                       // error: function(data){
                       //  var errors = $.parseJSON(data.responseText);
                       //  console.log(errors);
                       //   document.getElementById('prize_types').value = "";
                       //   document.getElementById('generate').value = "";
                       //   document.getElementById('winning_number').value = "";
                       //  $.each(errors, function (key, value) {

                       //      if($.isPlainObject(value)) {
                       //          console.log(value);
                       //          $.each(value, function (key, value) {                       
                       //              console.log(key+ " " +value);
                       //          $('#response-parent').show().append(value+"<br/>");

                       //          });
                       //      }else{
                       //          $('#response-parent').show().append(value+"<br/>"); //this is my div with messages
                       //      }

                       //      $('#' + key).parent().addClass('error');
                       //  });
                            
                       // }
                   // });
               

                });


            // var openmodal = document.querySelectorAll('.modal-open')
            // for (var i = 0; i < openmodal.length; i++) {
            //   openmodal[i].addEventListener('click', function(event){
            //     event.preventDefault()
            //     toggleModal()
            //   })
            // }

            $('.btn_ok').click(function(){
                location.reload();
            });
            
            // const overlay = document.querySelector('.modal-overlay')
            // overlay.addEventListener('click', toggleModal)
            
            // var closemodal = document.querySelectorAll('.modal-close')
            // for (var i = 0; i < closemodal.length; i++) {
            //   closemodal[i].addEventListener('click', toggleModal)
            // }
            
            // document.onkeydown = function(evt) {
            //   evt = evt || window.event
            //   var isEscape = false
            //   if ("key" in evt) {
            //     isEscape = (evt.key === "Escape" || evt.key === "Esc")
            //   } else {
            //     isEscape = (evt.keyCode === 27)
            //   }
            //   if (isEscape && document.body.classList.contains('modal-active')) {
            //     toggleModal()
            //   }
            // };
            
            
            function toggleModal () {
              const body = document.querySelector('body')
              const modal = document.querySelector('.modal')
              modal.classList.toggle('opacity-0')
              modal.classList.toggle('pointer-events-none')
              body.classList.toggle('modal-active')
            }




        });

        function prize_types_change(){
            var type = document.getElementById('prize_types').value;

            if(type == "Grand Prize"){
                document.getElementById('generate').disabled = true;
                document.getElementById('winning_number').disabled = true;
                document.getElementById('generate').value = "";
                document.getElementById('winning_number').value = "";
            }
            else{
                document.getElementById('generate').disabled = false;
                document.getElementById('winning_number').disabled = false;
                document.getElementById('winning_number').value = "";
            }
        }

        function generate_randomly(){
            var generate = document.getElementById('generate').value;

            if(generate == "Yes"){
                document.getElementById('winning_number').disabled = true;
                document.getElementById('winning_number').value = "";
            }
            else{
                document.getElementById('winning_number').disabled = false;
            }
        }

    </script>
</x-app-layout>
