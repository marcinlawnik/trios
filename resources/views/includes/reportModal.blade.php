<!-- Button trigger modal -->
<a class="report" data-toggle="modal" data-target="#reportModal">Report a mistake</a>

<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Report a mistake</h4>
            </div>
            <div class="modal-body">
                    <textarea id="report-description" class="form-control" id="recipient-name" placeholder="Description..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="report-button" class="btn btn-primary">Report</button>
            </div>
        </div>
    </div>
</div>