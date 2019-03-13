<div class="modal fade" id="modal-send-mail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" role="form" id="frmSendMail" action="/">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Gửi Mail</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Tiêu đề mail:</label>
                        <input type="text" class="form-control" v-model="mailSubject" name="mail_subject">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Nội dung:</label>
                        <textarea class="form-control" v-model="mailContent" rows="10" name="mail_content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="sendMail">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>