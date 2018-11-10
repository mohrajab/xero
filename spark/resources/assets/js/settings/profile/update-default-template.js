module.exports = {
    props: ['user'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({})
        };
    },


    methods: {
        /**
         * Update the user's profile photo.
         */
        update(e) {
            e.preventDefault();

            if (!this.$refs.default_template.files.length) {
                return;
            }

            var self = this;

            this.form.startProcessing();

            // We need to gather a fresh FormData instance with the profile photo appended to
            // the data so we can POST it up to the server. This will allow us to do async
            // uploads of the profile photos. We will update the user after this action.
            axios.post('/settings/default_template', this.gatherFormData())
                .then(
                    () => {
                        Bus.$emit('updateUser');

                        self.form.finishProcessing();
                        self.form.message = "Uploaded Successfully";
                    },
                    (error) => {
                        self.form.setErrors(error.response.data.errors);
                    }
                );
        },


        /**
         * Gather the form data for the photo upload.
         */
        gatherFormData() {
            const data = new FormData();

            data.append('default_template', this.$refs.default_template.files[0]);

            return data;
        }
    },


    computed: {
        /**
         * Calculate the style attribute for the photo preview.
         */
        fetchLink() {
            return `${this.user.default_template}`;
        }
    }
};
