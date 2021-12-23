{PHP_TAG}

namespace App\Modules\{MODEL_NAME_UCFIRST}\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class {MODEL_NAME_UCFIRST} extends Model
{
    use SoftDeletes;
    public  $table = '{PREFIX}{TABLE_NAME}';

    protected $fillable = [{MODEL_FORM_FIELD}];
}
