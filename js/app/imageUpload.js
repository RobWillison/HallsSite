Vue.component('fileupload', {
    template: ' \
    <button type="button" class="col-sm-2 col-sm-offset-4 btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">{{ name }}</button> \
\
<!-- Modal --> \
<div id="myModal" class="modal fade" role="dialog"> \
    <div class="modal-dialog"> \
\
    <!-- Modal content--> \
<div class="modal-content"> \
    <div class="modal-header"> \
    <button type="button" class="close" data-dismiss="modal">&times;</button> \
<h4 class="modal-title">{{ name }}</h4> \
</div> \
<div class="modal-body"> \
    <div v-if="has_error" class="alert alert-warning"> \
    <strong>Warning!</strong> {{ errortext }} \
</div> \
<div class="row"  v-for="image in images"> \
    <button @click="removeImage" data-item="{{ $index }}" type="button" class="image-remove">&times;</button> \
<img :src="image" class="upload-file-thumbnail"/> \
    </div> \
    </div> \
 \
    <div class="modal-footer">\
    <label class="btn btn-default btn-file"> \
    Browse for File<input @change="onFileChange" type="file" style="display: none;"> \
    </label> \
 \
    <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button> \
    </div> \
    </div> \
    </div> \
    </div> \
    ',

    props: {
        name: String,
        filetypes: {
            type: Array,
            default: ['image/png', 'image/jpeg'],
        },
        errortext: String,
        images: Array
    },

    data: function(){
        return {
            has_error: false,
        };
    },

    methods: {
        onFileChange: function (e) {
            var files = e.target.files || e.dataTransfer.files;
            var file = files[0];

            this.checkFileTypes(file);

            if (this.has_error) {
                return;
            }

            if (!files.length)
                return;

            this.addImage(file);
        },
        checkFileTypes: function (file) {
            this.has_error = false;

            if (this.filetypes.indexOf(file.type) == -1) {
                this.has_error = true;
            }
        },
        addImage: function(file) {
            var reader = new FileReader();

            var self = this;

            reader.onload = function(e){
                self.images.push(e.target.result);
            };

            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            item = $(e.srcElement).data('item');
            this.images.splice(item, 1);
        }
    }
});