
    @isset($student_sidebar)
    @foreach($student_sidebar as $sidebar)
            @php
            $parentMenu=Modules\MenuManage\Entities\UserMenu::studentParent($sidebar->parent_id);
            $parentSubMenus=Modules\MenuManage\Entities\UserMenu::childMenu($sidebar->parent_id); 
            @endphp
            @if(count($parentSubMenus)>0)
            <li>                                        
                <a href="#menu_{{$sidebar->parent_id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="{{$parentMenu->icon_class}}"></span>                            
                {{ __('lang.' . $parentMenu->lang_name) }}
                </a>
                <ul class="collapse list-unstyled" id="menu_{{$sidebar->parent_id}}">
                    @if(Auth::user()->role_id==3)
                    @foreach($childrens as $children)
                    <li>
                        <a href="{{route('parent_examination', [$children->id])}}">{{$children->full_name}}</a>
                    </li>
                    @endforeach
                    @endif
                        @foreach ($parentSubMenus as $submenu)    
                            @php
                                $parentSubMenu=Modules\MenuManage\Entities\UserMenu::studentParentSubMenu($submenu->module_id);
                            @endphp 
                                <li>                                            
                                    <a href="{{url($parentSubMenu->route !=''? $parentSubMenu->route :'/student-dashboard')}}"> 
                                        {{$parentSubMenu->name}} </a>
                                </li>                                
                    @endforeach     
                    
                </ul>
            </li>
            @else 
            <li>
                <a href="{{url($parentMenu->route)}}">
                    <span class="{{$parentMenu->icon_class}}"></span>
                 
                    {{ __('lang.' . $parentMenu->lang_name) }}
                </a>
            </li>
            @endif
    @endforeach    
    @if(intallMdouleMenu(2033,'BBB'))
            @include('bbb::menu.bigbluebutton_sidebar')                   
        @endif  

        @if(intallMdouleMenu(2030,'Jitsi'))
            @include('jitsi::menu.jitsi_sidebar')          
        @endif

        @if(intallMdouleMenu(2022,'Zoom'))
            @include('zoom::menu.Zoom')
        @endif 
@endisset


@isset($student_pre_assigns)
    @foreach($student_pre_assigns as $sidebar)
            @php
            $parentMenu=Modules\MenuManage\Entities\UserMenu::studentParent($sidebar->module_id);
            $parentSubMenus=Modules\MenuManage\Entities\UserMenu::preAssignChild($sidebar->id); 
            @endphp
            @if(count($parentSubMenus)>0)
            <li>                                        
                <a href="#menu_{{$sidebar->module_id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="{{$sidebar->icon_class}}"></span>                            
                {{ __('lang.' . $sidebar->lang_name) }}
                
                </a>
                <ul class="collapse list-unstyled" id="menu_{{$sidebar->module_id}}">
                   
                        @foreach ($parentSubMenus as $submenu)    
                           
                                <li>                                            
                                    <a href="{{url($submenu->route !=''? $submenu->route :'/student-dashboard')}}"> 
                                        {{ __('lang.' . $submenu->lang_name) }} </a>
                                </li>                                
                    @endforeach     
                    
                </ul>
            </li>
            @else 
            <li>
                <a href="{{url($sidebar->route)}}">
                    <span class="{{$sidebar->icon_class}}"></span>
                    {{ __('lang.' . $sidebar->lang_name) }}
                </a>
            </li>
            @endif
    @endforeach
@endisset










