<div class="page-wrapper default-theme sidebar-bg bg1 toggled">
    <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">{{config('app.name')}}</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name">Jhon
            <strong>Smith</strong>
          </span>
          <span class="user-role">Administrator</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>

      
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Geral</span>
          </li>
            @if (Route::has('pacientes.index'))
          <li class="sidebar-dropdown">
            <a >
                <i class="fa fa-tachometer-alt"></i>
                <span>Pacientes</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href=" {{route('pacientes.index')}} " ><span>Listagem</span>
                  </a>
                </li>
                <li>
                  <a href=" {{route('pacientes.create')}} ">Novo</a>
                </li>
              </ul>
            </div>
          
          </li>
            @endif
      
          <li class="header-menu">
            <span>Agenda</span>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
            
       <a href="http://fb.com/iagomussel">
        <i class="fa fa-power-off"></i><span>Suporte</span>
      </a>
    </div>
  </nav>
</div>