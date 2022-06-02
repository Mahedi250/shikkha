

@isset($parent_sidebar)
    @foreach ($parent_sidebar as $sidebar)
              @php
                    $parentMenu=Modules\MenuManage\Entities\UserMenu::studentParent($sidebar->parent_id);
                    $parentSubMenus=Modules\MenuManage\Entities\UserMenu::childMenu($sidebar->parent_id); 

                      $str = $parentMenu->route;
                      $pattern = "/{id}";
                      $result=str_contains($parentMenu->route, $pattern);
                      $url=str_replace('/{id}','',$parentMenu->route);
               @endphp

               @if($sidebar->module_id==1)
                <li>
                    <a href="{{url($parentMenu->route)}}">
                        <span class="{{$parentMenu->icon_class}}"></span>
                    
                        {{ __('lang.' . $parentMenu->lang_name) }}
                    </a>
                </li>
               @endif
               @if($sidebar->module_id !=1)
                    <li>                                        
                        <a href="#menu_{{$sidebar->parent_id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="{{$parentMenu->icon_class}}"></span>                            
            
                        {{ __('lang.' . $parentMenu->lang_name) }} 
                        </a>
                    <ul class="collapse list-unstyled" id="menu_{{$sidebar->parent_id}}">
                            
                              

                                @if(count($parentSubMenus)==0)
                                    @if($result !='')
                                        @foreach($childrens as $children)
                                            <li>                                            
                                                <a href="{{url( $url)}}/{{$children->id}}"> 
                                                {{$children->full_name}} </a>
                                            </li>  
                                        @endforeach  
                                  @else  
                                        @foreach($childrens as $children)
                                            <li>                                            
                                                <a href="{{url($parentMenu !=''? $parentMenu->route :'')}}/{{$children->id}}"> 
                                                {{$children->full_name}} </a>
                                            </li>  
                                        @endforeach  
                                 @endif
                               @endif
                              

                                @foreach ($parentSubMenus as $submenu)    
                                    @php
                                        $parentSubMenu=Modules\MenuManage\Entities\UserMenu::studentParentSubMenu($submenu->module_id);
                                        $str = $parentSubMenu->route;
                                        $pattern = "/{id}";
                                        $result=str_contains($parentSubMenu->route, $pattern);
                                        $url=str_replace('/{id}','',$parentSubMenu->route);

                                 @endphp 
                                    @if($result !='')
                                      @foreach($childrens as $children)
                                            <li>                                            
                                                <a href="{{url($url)}}/{{$children->id}}"> 
                                                    {{ __('lang.' . $parentSubMenu->lang_name) }} -{{$children->full_name}} </a>
                                            </li>  
                                      @endforeach  
                                    @else
                                        @foreach($childrens as $children)
                                            <li>                                            
                                                <a href="{{url($parentSubMenu->route !=''? $parentSubMenu->route :'/parent-dashboard')}}"> 
                                                    {{ __('lang.' . $parentSubMenu->lang_name) }} -{{$children->full_name}} </a>
                                            </li>  
                                        @endforeach                            
                                    @endif
                            @endforeach     
                            
                        </ul>
                    </li>
              @endif
    @endforeach
    <!-- BBB Menu  -->   
@if(intallMdouleMenu(2033,'BBB'))
@if(userPermission(105))
<li>
    <a href="#bigBlueButtonMenu" data-toggle="collapse" aria-expanded="false"
    class="dropdown-toggle">
        <span class="flaticon-reading"></span>
    @lang('lang.bbb')
    </a>
    <ul class="collapse list-unstyled" id="bigBlueButtonMenu">
        @if(userPermission(106))
            <li>
                <a href="{{ route('bbb.virtual-class')}}">@lang('lang.virtual_class')</a>
            </li>
        @endif
        @if(userPermission(107))
            <li>
                <a href="{{ route('bbb.meetings') }}">@lang('lang.virtual_meeting')</a>
            </li>
        @endif
    
    </ul>
</li>

@endif    
    
@endif
<!-- BBB  Menu end -->   
<!-- Jitsi Menu  -->      
@if(intallMdouleMenu(2030,'Jitsi'))
@if(userPermission(108))
<li>
    <a href="#subMenuJisti" data-toggle="collapse" aria-expanded="false"
    class="dropdown-toggle">
        <span class="flaticon-reading"></span>
    @lang('lang.jitsi')
    </a>
    <ul class="collapse list-unstyled" id="subMenuJisti">
        @if(userPermission(109))
            <li>
                <a href="{{ route('jitsi.virtual-class')}}">@lang('lang.virtual_class')</a>
            </li>
        @endif
        @if(userPermission(110))
            <li>
                <a href="{{ route('jitsi.meetings') }}">@lang('lang.virtual_meeting')</a>
            </li>
        @endif
      
    </ul>
</li>

@endif        
@endif
<!-- jitsi Menu end -->

  <!-- Zomm Menu  start -->
@if(intallMdouleMenu(2022,'Zoom'))

@if(userPermission(100))
<li>
    <a href="#zoomMenu" data-toggle="collapse" aria-expanded="false"
    class="dropdown-toggle">
        <span class="flaticon-reading"></span>
    Live Class
    </a>
    <ul class="collapse list-unstyled" id="zoomMenu">
        @if(userPermission(101))
            <li>
                <a href="{{ route('zoom.virtual-class')}}">@lang('lang.virtual_class')</a>
            </li>
        @endif
        @if(userPermission(103))
            <li>
                <a href="{{ route('zoom.meetings') }}">@lang('lang.virtual_meeting')</a>
            </li>
        @endif
    
    </ul>
</li>

@endif
@endif
<!-- zoom Menu  -->
@endisset



@isset($parent_pre_assigns)
    @foreach ($parent_pre_assigns as $sidebar)
              @php
                    $parentMenu=Modules\MenuManage\Entities\UserMenu::studentParent($sidebar->module_id);
                    $parentSubMenus=Modules\MenuManage\Entities\UserMenu::preAssignChild($sidebar->id); 

                    
               @endphp

                @if($sidebar->module_id==1)
                <li>
                    <a href="{{url($parentMenu->route)}}">
                        <span class="{{$parentMenu->icon_class}}"></span>
                    
                        {{ __('lang.' . $parentMenu->lang_name) }}
                    </a>
                </li>
                @endif
                @if($sidebar->module_id !=1)
                    <li>    
                                                    
                        <a href="#menu_{{$sidebar->module_id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="{{$parentMenu->icon_class}}"></span>                            
                        {{ __('lang.' . $parentMenu->lang_name) }} 
                        </a>
                        <ul class="collapse list-unstyled" id="menu_{{$sidebar->module_id}}">
                                        @if(count($parentSubMenus)==0)
                                            @foreach($childrens as $children)
                                                <li>                                            
                                                    <a href="{{url($parentMenu !=''? $parentMenu->route :'/my-children')}}/{{$children->id}}"> 
                                                    {{$children->full_name}} </a>
                                                </li>  
                                    @endforeach  
                                @endif
                            
                                @foreach ($parentSubMenus as $submenu) 

                                    @php
                                        $str = $submenu->route;
                                        $pattern = "/{id}";
                                        $result=str_contains($submenu->route, $pattern);
                                        $url=str_replace('/{id}','',$submenu->route);
                                    @endphp
                                      @if($result !='')
                                      @foreach($childrens as $children)
                                            <li>                                            
                                                <a href="{{url($url)}}/{{$children->id}}"> 
                                                    {{ __('lang.' . $submenu->lang_name) }} -{{$children->full_name}} </a>
                                            </li>  
                                      @endforeach  
                                    @else
                                    @foreach($childrens as $children)
                                        <li>                                            
                                            <a href="{{url($submenu->route !=''? $submenu->route :'/student-dashboard')}}"> 
                                                {{ __('lang.' . $submenu->lang_name) }} -{{$children->full_name}} </a>
                                        </li>  
                                    @endforeach                            
                                    @endif
                            @endforeach     
                            
                        </ul>
                    </li>
                 @endif   
    @endforeach
@endisset