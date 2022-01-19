<div class="position-relative w-100">
    <div class="loading">
        <div class="spinner-border"></div>
    </div>
    <div class="fit-content">
        <table {{ $attributes->merge(['class' => $elementName.'-table manager-table table table-bordered table-hover table-sm']) }} >
            <thead class="table-dark">
                <tr>
                    {{ $head }}
                    <th style="width: 50px">{{-- Table Action --}}</th>
                </tr>
            </thead>
            <tbody>
                {{ $body }}
            </tbody>
        </table>
        {{ $pagination }}
    </div>
</div>
