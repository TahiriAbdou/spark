<div class="panel panel-default" v-if="user.stripe_active">
    <div class="panel-heading">
        <div class="pull-left">
            Update Card
        </div>

        <div class="pull-right">
            <span v-if="user.last_four">
                <i class="fa fa-btn fa-cc-@{{ creditCardBrandIcon }}"></i>
                ************@{{ user.last_four }}
            </span>
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
        <spark-error-alert :form="updateCardForm"></spark-error-alert>

        <div class="alert alert-success" v-if="updateCardForm.successful">
            <strong>Done!</strong> Your card has been updated.
        </div>

        <form class="form-horizontal" role="form">
            <div class="form-group" :class="{'has-error': updateCardForm.errors.has('number')}">
                <label for="number" class="col-md-4 control-label">Card Number</label>

                <div class="col-md-6">
                    <input type="text"
                        class="form-control"
                        name="number"
                        data-stripe="number"
                        placeholder="************@{{ user.last_four }}"
                        v-model="updateCardForm.number">

                    <span class="help-block" v-show="updateCardForm.errors.has('number')">
                        <strong>@{{ updateCardForm.errors.get('number') }}</strong>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="cvc" class="col-md-4 control-label">Security Code</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="cvc" data-stripe="cvc" v-model="updateCardForm.cvc">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Expiration</label>

                <div class="col-md-3">
                    <input type="text" class="form-control" name="month" placeholder="MM" maxlength="2" data-stripe="exp-month" v-model="updateCardForm.month">
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" name="year" placeholder="YYYY" maxlength="4" data-stripe="exp-year" v-model="updateCardForm.year">
                </div>
            </div>

            <div class="form-group">
                <label for="zip" class="col-md-4 control-label">ZIP / Postal Code</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="zip" v-model="updateCardForm.zip">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" @click.prevent="updateCard" :disabled="updateCardForm.busy">
                        <span v-if="updateCardForm.busy">
                            <i class="fa fa-btn fa-spinner fa-spin"></i> Updating
                        </span>

                        <span v-else>
                            <i class="fa fa-btn fa-credit-card"></i> Update
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
