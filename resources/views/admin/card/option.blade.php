<div class="card" id="option">
    <div class="card-header widget-block">
        <h3 class="card-title">
            <strong>網站參數設定</strong>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.option.update') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <label for="websiteOpen" class="col-sm-2 col-form-label">網站開啟狀態</label>
                <div class="col-sm-10">
                    <select class="custom-select form-control-border" id="websiteOpen" aria-label="websiteOpen select" name="website_open">
                        <option value="true" @if($options['website.open'] === 'true') selected @endif>開啟</option>
                        <option value="false" @if($options['website.open'] === 'false') selected @endif>關閉</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="heavenKey" class="col-sm-2 col-form-label">註冊開放狀態</label>
                <div class="col-sm-10">
                    <select class="custom-select form-control-border" id="heavenKey" aria-label="heavenKey select" name="heaven_key">
                        <option value="true" @if($options['heaven.key'] === 'true') selected @endif>開啟</option>
                        <option value="false" @if($options['heaven.key'] === 'false') selected @endif>關閉</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="bannerText" class="col-sm-2 col-form-label">Banner標題文字</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="bannerText" value="{{ $options['banner.text'] }}" name="banner_text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="announcementText" class="col-sm-2 col-form-label">公告說明文字</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="announcementText" name="announcement_text" rows="5">{{ $options['announcement.text'] }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="deliverFree" class="col-sm-2 col-form-label">免運額</label>
                <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" id="deliverFree" value="{{ $options['deliver_free.price'] }}" name="deliver_free" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="deliverFee" class="col-sm-2 col-form-label">運費</label>
                <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" id="deliverFee" value="{{ $options['deliver_fee'] }}" name="deliver_fee" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="deliverFee" class="col-sm-2 col-form-label">開放區域</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen1" name="open_area[]" value="臺北市" @if(in_array('臺北市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen1">臺北市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen2" name="open_area[]" value="基隆市" @if(in_array('基隆市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen2">基隆市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen3" name="open_area[]" value="新北市" @if(in_array('新北市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen3">新北市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen4" name="open_area[]" value="宜蘭縣" @if(in_array('宜蘭縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen4">宜蘭縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen5" name="open_area[]" value="新竹市" @if(in_array('新竹市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen5">新竹市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen6" name="open_area[]" value="新竹縣" @if(in_array('新竹縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen6">新竹縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen7" name="open_area[]" value="桃園市" @if(in_array('桃園市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen7">桃園市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen8" name="open_area[]" value="苗栗縣" @if(in_array('苗栗縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen8">苗栗縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen9" name="open_area[]" value="臺中市" @if(in_array('臺中市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen9">臺中市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen10" name="open_area[]" value="彰化縣" @if(in_array('彰化縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen10">彰化縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen11" name="open_area[]" value="南投縣" @if(in_array('南投縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen11">南投縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen12" name="open_area[]" value="嘉義市" @if(in_array('嘉義市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen12">嘉義市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen13" name="open_area[]" value="嘉義縣" @if(in_array('嘉義縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen13">嘉義縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen14" name="open_area[]" value="雲林縣" @if(in_array('雲林縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen14">雲林縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen15" name="open_area[]" value="臺南市" @if(in_array('臺南市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen15">臺南市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen16" name="open_area[]" value="高雄市" @if(in_array('高雄市', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen16">高雄市</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen17" name="open_area[]" value="屏東縣" @if(in_array('屏東縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen17">屏東縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen18" name="open_area[]" value="臺東縣" @if(in_array('臺東縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen18">臺東縣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="areaOpen19" name="open_area[]" value="花蓮縣" @if(in_array('花蓮縣', json_decode($options['open.area']))) checked @endif>
                        <label class="form-check-label" for="areaOpen19">花蓮縣</label>
                    </div>
                </div>
            </div>
            @if ($errors->first('website_open'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $errors->first('website_open') }}</li>
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">儲存</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
