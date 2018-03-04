<?php $i=0;?>
@foreach ($posts as $post)
  <?php $i++;?>
  <tr>
    <td><?php echo $i;?></td>
    <td><strong>{{ $post->username }}</strong></td>
    <td>{{ $post->created_at }}</td>
    <td>{{ $post->ngaydaohan }}</td>
    <td>{{ $post->sotiencanvay }}</td>
    <td>{{ $post->phantramlai }}%</td>
    <td>{{ $post->kieuthechap }}</td>
    <td>
      <?php if($post->status =='0') {?>
           {{ trans('front/site.investPending') }}                          
      <?php  } ?>
      <?php if($post->status =='1') {?>
           {{ trans('front/site.investDone') }}                           
      <?php  } ?>
      <?php if($post->status =='2') {?>
           {{ trans('front/site.investWork') }}                           
      <?php  } ?>
      <?php if($post->status =='3') {?>
           {{ trans('front/site.investPause') }}                          
      <?php  } ?>
      <?php if($post->status =='4') {?>
           {{ trans('front/site.investCompleted') }}                          
      <?php  } ?>          
    </td>
    <td>{!! link_to('invest/' . $post->id, trans('back/blog.see'), ['class' => 'btn btn-success btn-block btn']) !!}</td>
    <td>
    {!! Form::open(['method' => 'DELETE', 'route' => ['invest.destroy', $post->id]]) !!}
      {!! Form::destroy(trans('back/blog.destroy'), trans('back/blog.destroy-warning')) !!}
    {!! Form::close() !!}
    </td>
  </tr>
@endforeach