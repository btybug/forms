<div class="form-group">
    <label>Select Layout</label>
    {!! BBbutton2('unit','form_layout','form_layout','Select Layout',['class'=>'form-control','model'=>$form]) !!}
</div>

<hr style="border-color: #bdbdbd;" />

<div class="row">
    <div class="col-md-12">
        <div class="form-group m-l-0 m-r-0">
            <label>Success Message</label>
            <input class="form-control" name="message" type="text">
        </div>

        <div class="form-group m-l-0 m-r-0">
            <label>Event/Trigger</label>
            <select class="form-control" name="event"><option value="" selected="selected">Select Event</option><option value="App\Events\AfterLoginEvent">After Login</option><option value="App\Events\AfterLogOutEvent">After Log out</option><option value="Illuminate\Auth\Events\Registred">on registred</option><option value="App\Events\FormSubmit">on Form Submit</option><option value="App\Events\PageCreateEvent">on Page Create</option></select>
        </div>

        <div class="form-group m-l-0 m-r-0">
            <label>Redirect Page</label>
            <select id="target" class="form-control" name="redirect_Page" title="Select Target">
                <option value="alert">BB get page</option>
            </select>
        </div>

        <div class="form-group m-l-0 m-r-0">
            <label>
                <input name="is_ajax" id="is_ajax_yes" value="yes" type="checkbox">
                Is Ajax
            </label>
        </div>
    </div>
</div>