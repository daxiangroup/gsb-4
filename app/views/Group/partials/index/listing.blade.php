<div class="listing group-study" data-id="{{ $group->getId() }}">
    <div class="lbl">Name:</div>
    <div class="fld">{{ $group->getName() }}</div>

    <div class="lbl">Headline:</div>
    <div class="fld">{{ $group->getHeadline() }}</div>

    <div class="lbl">Graduating Year:</div>
    <div class="fld">{{ $group->getGraduatingYear() }}</div>

    <div class="lbl">Max Size:</div>
    <div class="fld">{{ $group->getMaxSize() }}</div>
</div>