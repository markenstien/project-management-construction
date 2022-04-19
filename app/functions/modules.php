<?php 


    // function actions($name , $actions = [])
    // {
    //  $prefix = 'ACTIONS';

    //  Session::set($prefix.'_'.$name , $actions);

    //  $actions = Session::get($prefix);

         
    //  return true;
    // }

    // function fetchActions($name = '')
    // {
    //  if( empty($name ))
    //  {

    //  }
    // }
    
    function withinNightDiffRange($in,$out , $start , $end)
    {
        $start = strtotime($in);
        $end   = strtotime($out);
        
        if(time() >= $start && time() <= $end) {
          // ok
        } else {
          // not ok
        }
    }


    function wProgressBar($value , $attributes = null)
    {   

        $color  = 'primary';

        $size   = '15px';

        if( ! is_null($attributes) )
        {
            if( is_string($attributes) )
                $color = $attributes;
            if( is_array($attributes) ){
                $size = $attributes['size'] ?? '15px';
            }
        }

        if( $value > 60){
            $color = 'success';
        }elseif($value < 50 && $value > 30) {
            $color = 'primary';
        }elseif($value < 30){
            $color = 'warning';
        }

        if( $value < 3)
            $color = 'danger';

        $html = <<<EOF
        <div class="progressbar-list">
            <div class='progress' style="height:{$size}">
                <div class="progress-bar progress-bar-striped bg-{$color} progress-bar-animated"
                    role="progressbar" style="width:{$value}%"
                    aria-valuenow="{$value}"
                    aria-valuemin="0" aria-valuemax="100"
                </div>
                {$value}%
            </div>
        </div>
        EOF;

        return $html;
    }

    function wProjectInvites( $email = '')
    {   
        
    }


    function wProjectNavigation( $projectId )
    {
        $expensesRoute =  _route('sop:index' , $projectId);
        $sopRoute =  _route('pie:index' , $projectId);
        $taskRoute =  _route('task:index' , $projectId);
        $milestoneRoute =  _route('milestone:index' , $projectId);
        $peopleRoute =  "/ProjectIndividualController/index/{$projectId}";


        print <<<EOF
            <ul class="nav nav-pills justify-content-end">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" 
                    href="{$expensesRoute}">Expenses</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" 
                    href="{$sopRoute}">Slicing Pie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$taskRoute}">Tasks</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$milestoneRoute}">Milestones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$peopleRoute}">People</a>
              </li>
            </ul>
        EOF;
    }


    function mProjectClassifications()
    {
        return [
            'Residential' , 'Commercial'
        ];
    }


    function mProjectTypes()
    {
        return [
            'Renovation' , 'New Project'
        ];
    }

    function mIsCustomer()
    {
        if( isEqual(whoIs('type') , 'customer') )
            return true;
        return false;
    }

    function mIsManagement()
    {
        if( isEqual(whoIs('type') , 'management') )
            return true;
        return false;
    }