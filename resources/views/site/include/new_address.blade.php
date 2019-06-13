<div class="modal fade" id="new_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-right">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title w-100 text-center" id="myModalLabel">آدرس جدید</h5>
            </div>
            <div class="modal-body">

                <form id="address_form" onsubmit="add_address();return false;" action="{{ url('shop/add_address') }}" method="post">
                    {{ csrf_field() }}
                    <table class="tbl_address">

                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <label for="name-input">نام و نام خانوادگی</label>
                                    <input name="name"  id="name-input" class="form-control"   value="{{ old('name') }}">
                                    
                                 </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">

                                <span id="error_name" class="has-error"></span>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label>انتخاب استان</label>
                                    <select name="ostan_id"  class="selectpicker" onchange="get_shahr('ostan_id','shahr_list')" id="ostan_id">
                                        <option value="">انتخاب استان</option>
                                        @foreach($ostan as $key=>$value)
                                            <option value="{{ $value->id }}">{{ $value->ostan_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </td>
                            <td>
                                <div class="form-group">
                                    <label>انتخاب شهر</label>
                                    <select name="shahr_id"  class="selectpicker" id="shahr_list">

                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <span id="error_ostan_id" class="has-error"></span>

                            </td>
                            <td>

                                <span id="error_shahr_id" class="has-error"></span>

                            </td>
                        </tr>


                        <tr>
                            <td>
                                <div class="form-group">

                                    <label for="phone-input">تلفن ثابت</label>
                                    <input type="text" id="phone-input" name="tell" value="{{ old('tell') }}" class="form-control">
                                    
                                     
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="code-city">کد شهر</label>
                                    <input type="text" id="code-city" class="form-control" value="{{ old('tell_code') }}" name="tell_code">
                                    
                                     
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <span id="error_tell" class="has-error"></span>

                            </td>
                            <td>

                                <span id="error_tell_code" class="has-error"></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="mobile-number">شماره موبایل</label>
                                    <input type="text" id="mobile-number" value="{{ old('mobile') }}" class="form-control" name="mobile">
                                    
                                     
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="zip-code">کد پستی</label>
                                    <input type="text" id="zip-code" value="{{ old('zip_code') }}"  name="zip_code" class="form-control" placeholder="">
                                   
                                     
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <span id="error_mobile" class="has-error"></span>

                            </td>
                            <td>

                                <span id="error_zip_code" class="has-error"></span>

                            </td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <div>
                                    <label>آدرس </label>
                                    <textarea name="address" style="width:98%;border: 1px solid #26c6da;border-radius: 5px;" class="form-control">{{ old('address') }}</textarea>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span id="error_address" class="has-error"></span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <button class="btn btn-success">ثبت آدرس</button>
                            </td>
                        </tr>

                    </table>
                </form>

            </div>

        </div>
    </div>
</div>
