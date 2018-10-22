<spark-update-default-template :user="user" inline-template>
    <div class="card card-default" v-if="user">
        <div class="card-header">{{__('Default Invoice Template')}}</div>

        <div class="card-body">
            <div class="alert alert-danger" v-if="form.errors.has('default_template')">
                @{{ form.errors.get('default_template') }}
            </div>

            <div class="alert alert-success" v-if="form.message">
                @{{ form.message }}
            </div>

            <form role="form">
                <div class="form-group row justify-content-center">
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="image-placeholder mr-4">
                            <span class="profile-photo-preview2"></span>
                        </div>
                        <div class="spark-uploader mr-4">
                            <input ref="default_template" type="file" class="spark-uploader-control" name="default_template" @change="update" :disabled="form.busy">
                            <div class="btn btn-outline-dark">{{__('Upload Template')}}</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-default-template>
