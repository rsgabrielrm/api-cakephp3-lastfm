<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Songs Model
 *
 * @method \App\Model\Entity\Song get($primaryKey, $options = [])
 * @method \App\Model\Entity\Song newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Song[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Song|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Song|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Song patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Song[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Song findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SongsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('songs');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('artist')
            ->maxLength('artist', 255)
            ->requirePresence('artist', 'create')
            ->notEmpty('artist');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('album')
            ->maxLength('album', 255)
            ->requirePresence('album', 'create')
            ->notEmpty('album');

        $validator
            ->scalar('cover')
            ->maxLength('cover', 255)
            ->requirePresence('cover', 'create')
            ->notEmpty('cover');

        $validator
            ->add('music', [
              'mimeType' => [
                  'rule' => ['extension', ['mp3']],
                  'message' => 'Please upload file only (mp3).',
              ],
              'fileSize' => [
                  'rule' => ['fileSize', '<=', '10MB'],
                  'message' => 'Music must be less than 10MB.',
              ],
            ]);

        return $validator;
    }
}
