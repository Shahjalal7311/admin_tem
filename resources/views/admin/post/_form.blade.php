<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<!-- Title of Post Form Input -->
<div class="form-group @if ($errors->has('title')) has-error @endif">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title of Post']) !!}
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>
<!-- Text Form Input -->
<!-- Text Form Input -->
<div class="form-group @if ($errors->has('photo')) has-error @endif">
    {!! Form::label('photo', 'Photo',['class' => 'control-label']) !!}
    <?php
      if(!empty($post)){
    ?>            
      <div class="form-group">
        <div class="row">
            <?php
              $getmedia = $post->getMedia('post');
              foreach($getmedia as $key=>$file){
                $publicUrl = $getmedia[$key]->getUrl();
            ?>
            <div class="col-md-3 col-sm-3 image_margin_left" style="margin-bottom: 10px;min-width: 167px;">
              <a href="<?= $publicUrl ?>" data-lightbox="roadtrip">  
                <img src="<?= $publicUrl ?>" class="img-responsive" style="min-width: 170px;height: 182px;">
                <div data-id="<?= $file->id ?>" class="c-drag-and-drop-preview__remove-icon adminimage_remove icon_adjutment" data-dz-remove></div>
              </a>
            </div>
            <?php 
              }
             ?>
        </div>
      </div>
    <?php } ?>
    <div class="c-form-block">
        <div class="c-drag-and-drop-preview-container js-dropzone-previews-container"></div>
        <div class="c-drag-and-drop-preview js-dropzone-preview">
          <div class="dz-preview dz-file-preview" style="margin:0px;margin-top: 6px;min-width: 172px;">
            <div class="c-drag-and-drop-preview__remove-icon" data-dz-remove></div>
            <img class="facility-image" style="width: 100%" data-dz-thumbnail alt="" />
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
          </div>
        </div>
        <div class="c-drag-and-drop-area needsclick dropzone js-dropzone" id="document-dropzone"></div>
    </div>
</div>
<!-- Text body Form Input -->
<div class="form-group @if ($errors->has('body')) has-error @endif">
    {!! Form::label('body', 'Body') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control my-editor', 'placeholder' => 'Body of Post...']) !!}
    @if ($errors->has('body')) <p class="help-block">{{ $errors->first('body') }}</p> @endif
</div>

<style>
    .c-drag-and-drop-area{ 
      height: 230px;
      border: 1px dashed #f39c12;
      cursor: pointer;
      border-radius: 4px;
    }
    .dz-complete{
        width: 173px;
        float: left;
        margin-right: 10px !important;
    }
    .dz-complete .c-drag-and-drop-preview__remove-icon::before {
      content: 'x';
      color: #333;
      font-weight: 300;
      font-family: Arial, sans-serif;
      position: absolute;
      font-size: 30px;
      margin-left: 8px;
      margin-top: -7px;
      cursor: pointer;
    }
</style>
