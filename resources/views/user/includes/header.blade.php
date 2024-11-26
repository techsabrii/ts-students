
<style>



</style>
<header class="ts-header">
  <div class="ts-top">
      <div class="ts-logo">
        <a href="{{ url('profile')}}"><div>{{ old('student_name', Auth::user()->student_name ?? '') }}</div></a>
      </div>
      <nav class="ts-nav">
        <ul>

                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">
                        <i class="fa-solid fa-video"></i>
                    </a>
                </li>
                <li class="{{ request()->is('code') ? 'active' : '' }}">
                    <a href="{{ url('code') }}">
                        <i class="fa-solid fa-code"></i>
                    </a>
                </li>
                <li class="{{ request()->is('doc') ? 'active' : '' }}">
                    <a href="{{ url('doc') }}">
                        <i class="fa-solid fa-book"></i>
                    </a>
                </li>

                <li class="{{ request()->is('some-other-path') ? 'active' : '' }}">
                    <a href="" style="font-size: 16px;">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </a>
                </li>
                <li class="{{ request()->is('fee') && ('registration-status') ? 'active' : '' }}">
                    <a href="{{ url('fee') }}" id="show-popup">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </a>
                </li>




        </ul>
    </nav>

      <div class="ts-icons">
          <div class="ts-search">
              <input type="text" placeholder="Search TST">
              <i class="fas fa-search"></i>
          </div>

          <a href="#" id="show-popup" class="fab "><i class="fas fa-plus"></i></a>

          <a href="#" id="comments-icon">
            <i class="fas fa-comment"></i>
            {{-- <span class="badge" id=""></span>unseen-message-badge --}}
            </a>
        <div class="chat-list" id="chat-list">

        </div>


          <a  href="">
            <i class="fas fa-bell"></i>
            <span class="badge badge-danger" id="notification-badge" style="display: none;">0</span>
        </a>
          <a href="">

            <i class="fas fa-user-friends"></i>
            <span class="badge badge-danger" id="friend-requests-badge" style="display: none;"></span>


        </a>

        <div class="dropdown">
          <img src="{{ asset('storage/' . old('image_path', auth()->user()->image_path)) }}" class="rounded-circle img-thumbnail useravatar" id="useravatar"
               style="width: 65px; height: 65px; object-fit: cover; cursor: pointer;"
               onclick="toggleDropdown()">
          <div class="dropdown-content" id="dropdownContent">
              <a href="{{ url('profile')}}"><i class="fas fa-user"></i> Profile</a>
              <a href="{{ url('courses')}}"><i class="fa-solid fa-book"></i> My Cources</a>
              <a href="{{ url('lectures')}}"><i class="fa-solid fa-video"></i> Lectures</a>
              <a href="{{url('fee')}}"><i class="fa-solid fa-dollar-sign"></i> Fee Submition</a>
              <a href="{{ url('setting')}}"><i class="fas fa-cog"></i> Settings</a>
              <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>


          </div>
      </div>
        </div>
      </div>
  </div>
</header>


<div id="options-popup" class="popup-overlay">
    <div class="popup-content">
        <span id="close-options-popup" class="close">&times;</span>
        <h2>Choose an Option</h2>
        <div class="options">
            <a href="{{url('fee')}}" class="option">
                <i class="fa-solid fa-dollar-sign"></i>Course Fee Submission
            </a>
            <a href="{{url('registration-status')}}" class="option">
                <i class="fa-solid fa-dollar-sign"></i> Student Registration
            </a>

        </div>
    </div>
</div>








<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById('dropdownContent');
        dropdownContent.classList.toggle('show');
    }


    window.onclick = function(event) {
        if (!event.target.matches('.useravatar')) {
            var dropdowns = document.getElementsByClassName('dropdown-content');
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
  </script>









