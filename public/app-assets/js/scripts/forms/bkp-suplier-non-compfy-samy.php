<script type="text/javascript" src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js"></script>
<style>
 .upper-section textarea.form-control {
   width: 100% !important;
   height: 34px;
}
.upper-section h5 {
  color: #525f7f;
  max-width: 100%;
  margin-bottom: 5px;
   font-weight: 700;
}

.classification {
   margin-top: 25px;
}
.upper-section .input-group {
   color: #525f7f;
   max-width: 100%;
  font-weight: 700;
}
  .table-custom{
/*        width: 80%;*/
    margin: 0 auto;
    margin-top: 20px !important;
  }
.table.table-custom>thead>tr>th {
    border-bottom: 1px solid #000;
}
.table.table-custom>tbody>tr>td {
    border-top: 1px solid #000;
}
 .table.table-custom>tbody>tr>th {
    border-top: 1px solid #000;
}
.modal-footer.new-footer {
    border: 0;
    padding: 20px 0px;
}
.modal-content.custom-modal{
    padding: 30px 30px;
    float: left;
}
.new-modal-body{
  padding: 15px 0px;
}
.input-group {
  width: 100%;
}
.select-radio {
   margin-right: 10px !important;
   margin-bottom: 9px !important;
}
@media only screen and (max-width: 991px) {
  .modal-content.custom-modal {
   padding: 15px;
  float: inherit;
   }
   .table-custom {
     padding: 15px;
    display: block;
    overflow-x: scroll;
     border-top:0 ;
 }
 .modal-footer.new-footer
  {
  padding-right: 15px;
  }
  .table.table-custom > thead > tr > th {
    border-top: 1px solid #000 !important;
  }
}
.header-table td {
   padding: 10px;
   font-size: 14px;
}
.image-sec {
   width: 200px;
    padding: 10px;
}
.header-table {
   margin-bottom: 20px;
}
.image-sec img {
   width: 123px;
   height: 70px;
   object-fit: contain;
}
</style>
<script src="{{ asset('js/product.js?v=' . rand(0,5000)) }}"></script>
<!DOCTYPE html>
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content custom-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          <span style="color:#8898aa;"></span>
        </h4>
      </div>
      <div class="modal-body new-modal-body">
        <form name="ac_frm" id="non_conformity_frm" method="post" action="" enctype='multipart/form-data'>
          @csrf
           <input type="hidden" name="order_id" value="{{$id}}">
        <div class="upper-section">
          <div class="row">
            <table border="1" width="100%" class="header-table">
               <tr>
                      <td>Form: Non-Conformity/Complaint/Improvement <br/>and Corrective Action report</td>
                      <td colspan="2">No: QOP-107F-01</td>
                      <th rowspan="2" class="image-sec"><img src="/public/img/quality-control-logo.png"> </th></tr><tr><td>Version:03</td>
                       <td>Validity date: 30.07.2023</td>
                       <td><input  id="index-nc" type="hidden" name="nc_index" value=""><span id="index"></span></td>
                </tr>
              </table>
            </div>
          
          <div class="row upper-row">
                <div class="col-md-4">
                   <div class="form-group">
                    <label>  Select type</label>
                  
                     <div class="input-group">
                        <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                        <select name="type" id="type" class="form-control">
                          <option value="complaint">Complaint</option>
                          <option value="non-conformity"> Non-Conformity</option>
                          <option value="improvement-action"> Improvement Action</option>
                        </select>
                      </div>
                   </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                    <div class="form-group">
                      <label>  Enter name</label>
                  
                     <div class="input-group">
                       <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                         </span>
                       <input type="text" class="form-control" name="reporting_person"required/>
                      </div>
                   </div>
                </div>
              </div>

                <div class="col-md-4">
                   <div class="form-group">
                    <label>  Job Description</label>
                  
                     <div class="input-group">
                       <span class="input-group-addon">
                         <i class="fa fa-user"></i>
                      </span>
                      <textarea class="form-control" name="job_description"required></textarea>
                      
                      </div>
                   </div>
                </div>

          </div>
          <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                    <label>  Customer reference</label>
                  
                     <div class="input-group">
                        <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                        <input type="text" class="form-control" name="customer_reference"required/>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                    <label>Quantity Reported</label>
                     <div class="input-group">
                       <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                         </span>
                       <input type="text" class="form-control" name="quantity_reported"required/>
                      </div>
                   </div>
                </div>
            </div>
        <div class="row">
          <div class="col-md-4">
             <div class="form-group">
         
              <label> Date of Investigation</label>
               <div class="input-group">
                  <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </span>
                 <input type="Date" class="form-control" name="investigation_date"required/>
                </div>
             </div>
          </div>
          <div class="col-md-4">

             <div class="form-group">
              <label>Investigation Team</label>
               <div class="input-group">
                 <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                   </span>
                 <textarea name="investigation_team" class="form-control" id=""required></textarea>
                </div>
             </div>
            </div>
             <div class="col-md-4">
               <div class="form-group">
                <label>Investigation Conclusion</label>
                 <div class="input-group">
                   <span class="input-group-addon">
                     <i class="fa fa-user"></i>
                  </span>
                   <textarea name="investigation_conclusion" class="form-control"required> </textarea>
                  </div>
               </div>
            </div>
          </div>
        <div class="row">
           <div class="col-md-12 ck-edit">
                   <div class="form-group">
                     <label>Description</label>
                       <div class="input-group">
                        
                          <!--  <span class="input-group-addon">
                             <i class="fa fa-user"></i>
                          </span> -->
                         <textarea  class="form-control" id="description-text" name="description"required> </textarea>
                       </div>
                   </div>
            </div>
        </div>

          <div class="row">
             <?php $causes = collect( config('rootcause.causes') );?>
             <div class="col-md-4">
                <div class="form-group">
                 <label> Root Cause Analysis</label>
                   <div class="input-group">
                     <!-- <textarea name="root_cause_analysis" class="form-control"> </textarea> -->
                     <select name="root_cause_analysis" id="root_cause" class="form-control">
                        @foreach($causes as $key => $cause)
                            <option value="{{$key}}">{{$cause}}</option>
                        @endforeach
                      </select>
                   </div>
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group classification">
                    
                     <input type="radio" class="select-radio" name="non_conformity_classification" value="major-non-conformity"required/>
                     <label>Major Non-Conformity</label>
                   </div>
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                   <div class="input-group classification">
                     <input type="radio" class="select-radio" name="non_conformity_classification" value="minor-non-conformity"required/ >
                     <label>   Minor Non-Conformity</label>
                   </div>
                </div>
             </div>
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                 <h5>Correction actions performed</h5>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <h5>Costumer notification</h5>
               </div>
            </div>
          </div>
          <div class="row">
             <div class="col-md-6">
               <div class="form-group">
                  <div class="input-group">
                     <input type="hidden" name="correct_action_performed[correct_act_per]" value="Correction actions performed">
                     <div>
                     <input type="radio" class="select-radio"  name="correct_action_performed[selection]" value="yes">Yes
                     <input type="radio"  class="select-radio" name="correct_action_performed[selection]" value="no">No
                     </div>
                     <div>Comment:
                     <textarea name="correct_action_performed[comment]" class="form-control"></textarea>
                     </div>
                   </div>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                  <div class="input-group">
                    <div>
                         <input type="radio" class="select-radio"  name="customer_notification[selection]" value="yes" />Yes
                         <input type="radio" class="select-radio"  name="customer_notification[selection]" value="no" >No
                    </div>
                    <div>Comment:
                        <textarea name="customer_notification[comment]" class="form-control"></textarea>
                    </div>
                   </div>
               </div>
             </div>
          </div>
           <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                 <h5>Stop the process</h5>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <h5>Impact on previous Orders</h5>
               </div>
            </div>
          </div>
          <div class="row">
             <div class="col-md-6">
               <div class="form-group text-group">
                  <div class="input-group">
                     <div>
                       <input type="radio" class="select-radio" name="stop_process[selection]" value="yes" >Yes
                       <input type="radio" class="select-radio" name="stop_process[selection]" value="no" >No
                     </div>
                     <div> Comment: 
                     <textarea name="stop_process[comment]" class="form-control"></textarea>
                     </div>
                   </div>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                  <div class="input-group text-group">
                    <div>
                     <input type="radio" class="select-radio" name="impact_previouse_order[selection]" value="yes">Yes
                       <input type="radio" class="select-radio" name="impact_previouse_order[selection]" value="no">No
                     </div>
                     <div>Comment:
                        <textarea name="impact_previouse_order[comment]" class="form-control"></textarea>
                     </div>
                   </div>
               </div>
             </div>
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                 <h5>Impact on risk assessment</h5>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <h5>Corrective actions needed</h5>
               </div>
            </div>
          </div>
          <div class="row">
             <div class="col-md-6">
               <div class="form-group">
                  <div class="input-group">
                    <div>
                     <input type="radio" class="select-radio" name="impact_risk_assessment[selection]" value="yes">Yes
                     <input type="radio" class="select-radio" name="impact_risk_assessment[selection]" value="no">No
                     </div>
                     <div>Comment:
                     <textarea name="impact_risk_assessment[comment]" class="form-control"></textarea>
                     </div>
                   </div>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                  <div class="input-group">
                    <div>
                     <input type="radio" class="select-radio" name="correct_action_needed[selection]" value="yes">Yes
                     <input type="radio" class="select-radio" name="correct_action_needed[selection]" value="no">No
                     </div>
                     <div>Comment:
                     <textarea name="correct_action_needed[comment]" class="form-control"></textarea>
                     </div>
                   </div>
               </div>
             </div>
          </div>
        </div>
        <div>
        <div class="row"><p class="text">Choice of Corrective Actions for preventing recurrence of the problem<p>
                <table class="table table-custom" border="1" >
                    <tbody>
                        <tr>
                           <td colspan="4"><textarea style="width: 100%;border: none;" name="choice_corrective_action[description]"></textarea></td>
                        </tr>
                        <tr>
                            <td><p>Name & Signature</p></td>
                            <td> <input type="text" class="form-control" name="choice_corrective_action[name_sign]"></td>
                            <td><p>Date</p></td>
                            <td><input type="date" class="form-control" name="choice_corrective_action[date]"></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </div>
          <div class="row">
            <table class="table table-custom" border="1" >
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Assigned to</th>
                  <th scope="col">Due date</th>
                  <th scope="col">Effective Date</th>
                  <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Act as costumer's requirement (if not against Actual's Policy)</th>
                  <td><input type="text" name="folllow_up[as_per_requirement][assigned_to]" class="form-control"></td>
                  <td><input type="date" name="folllow_up[as_per_requirement][due_date]" class="form-control"> </td>
                  <td><input type="date" name="folllow_up[as_per_requirement][effective_date]" class="form-control"> </td>
                  <td><textarea name="folllow_up[as_per_requirement][comment]" class="form-control"></textarea> </td>
                </tr>
                <tr>
                  <th scope="row">Process continuesfollowing QA approval</th>
                  <td><input type="text" name="folllow_up[process_continue][assigned_to]" class="form-control"></td>
                  <td><input type="date" name="folllow_up[process_continue][due_date]" class="form-control"> </td>
                  <td><input type="date" name="folllow_up[process_continue][effective_date]" class="form-control"> </td>
                  <td><textarea name="folllow_up[process_continue][comment]" class="form-control"></textarea></td>
                </tr>
                <tr>
                  <th scope="row"> All affected Orders have been repaired</th>
                  <td><input type="text" name="folllow_up[all_affected_order][assigned_to]" class="form-control"></td>
                  <td><input type="date" name="folllow_up[all_affected_order][due_date]" class="form-control"> </td>
                  <td><input type="date" name="folllow_up[all_affected_order][effective_date]" class="form-control"> </td>
                  <td><textarea name="folllow_up[all_affected_order][comment]" class="form-control"></textarea></td>
                </tr>
                <tr>
                  <th scope="row"> Corrective action have been implemented and found effective</th>
                  <td><input type="text" name="folllow_up[corrective_action_implement][assigned_to]" class="form-control"></td>
                  <td><input type="date" name="folllow_up[corrective_action_implement][due_date]" class="form-control"> </td>
                  <td><input type="date" name="folllow_up[corrective_action_implement][effective_date]" class="form-control"> </td>
                   <td><textarea name="folllow_up[corrective_action_implement][comment]" class="form-control"></textarea></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="row">
              <div class="col-md-12 col-12 form-group">
                    <div class="row form-align-items">
                        <label for="fileupload" class="col-md-4 col-12 control-label">
                                   Images
                        </label>
                        <div class="col-md-12 col-12">
                            <div data-dz class="dropzone dropzoneProduct" id="imagesUpload2"></div>
                        </div>
                    </div>
                </div>
          </div>
          <input type="hidden" id="images_all" name="images_all" >
          <div class="row">
             <div class="modal-footer new-footer">
                <button type="submit" id="add_non_rating" class="btn btn-primary">@lang( 'messages.save' )</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
              </div>
          </div>
          
        </form>
      </div>
  
      
  </div>
</div>

<script type="text/javascript">
    let editor;
    ClassicEditor
        .create( document.querySelector( '#description-text' ), )
        .then( newEditor => {
            editor = newEditor;

        } )
        .catch( error => {
            console.error( error );
        } );
        $(document).on('click', '#add_non_rating', function(e) {
              e.preventDefault();
              const editorData = editor.getData();
              document.getElementById('description-text').innerHTML = editorData ;
              
              var data = $('#non_conformity_frm').serialize();
              $.ajax({
                  method: 'POST',
                  url: "{{ route('save_non_conformity') }}",
                  dataType: 'json',
                  data: data,
                  success: function(result) {
                      $('div.view_modal').modal('hide');
                      if (result.success == true) {
                          toastr.success(result.msg);
                          location.reload();
                      } else {
                          toastr.error(result.msg);
                      }
                  },
              });
          });
    
    $(document).on('change', '#type',function(e){
        var type= this.value;
        if(type == 'complaint'){
            main_text = 'CO'
        }else if(type == 'non-conformity'){
            main_text = 'NC'
        }else if(type == 'improvement-action'){
            main_text = 'AI'
        }else{
            main_text = 'CO'
        }
        $("#index").text($("#index").text().replace(/^.{2}/g, main_text));
        $("#index-nc").val($("#index-nc").val().replace(/^.{2}/g, main_text));
    });

    // tinymce.init({
    //         selector: 'textarea#description-text',
    //         plugins: 'image colorpicker',
    //         toolbar: 'undo redo | bold italic underline | forecolor backcolor | image',
    //         toolbar: 'image',
    //         file_picker_types: 'image', // Only allow image files
    //         file_picker_callback: function (callback, value, meta) {
    //             if (meta.filetype === 'image') {
    //                 var input = document.createElement('input');
    //                 input.setAttribute('type', 'file');
    //                 input.setAttribute('accept', 'image/*');

    //                 input.onchange = function () {
    //                     var file = this.files[0];
    //                     var reader = new FileReader();

    //                     reader.onload = function () {
    //                         callback(reader.result, { text: file.name });
    //                     };

    //                     reader.readAsDataURL(file);
    //                 };

    //                 input.click();
    //             }
    //         },
    //         height: 200
    //     });

   
</script>
