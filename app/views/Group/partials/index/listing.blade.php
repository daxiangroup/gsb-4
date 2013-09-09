<div class="row-fluid group-study" data-id="{{ $group->getId() }}">
    <div class="span1">
        <div style="width:70px; height:70px; background:#c00"></div>
    </div>
    <div class="span11">
        <div class="row-fluid">
            <div class="span12">
                <h4>{{ $group->getName() }}</h4>
                {{ $group->getHeadline() }}
            </div>
        </div>
        <div class="row-fluid"></div>

        <div class="lbl">Headline:</div>

        <div class="lbl">Graduating Year:</div>
        <div class="fld">{{ $group->getGraduatingYear() }}</div>

        <div class="lbl">Max Size:</div>
        <div class="fld">{{ $group->getMaxSize() }}</div>
    </div>
</div>