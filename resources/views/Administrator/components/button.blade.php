<button type="button" id="{{$buttonID}}" class="btn btn-primary w-100"
    onclick="{{$buttonFunction}}('{{$buttonFormID}}', '{{$buttonID}}', '{{$buttonSpan}}','{{$buttonUrl}}')">
    <div id="{{$buttonID}}-spinner" class="spinner-border" role="status" style="display: none;"></div>
    <span id="{{$buttonSpan}}">{{$buttonLabel}}</span>
</button>