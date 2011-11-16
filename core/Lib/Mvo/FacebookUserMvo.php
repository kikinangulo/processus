<?php

/** 
 * @author francis
 * 
 * 
 */
namespace Processus\Lib\Mvo
{
    use Processus\Dto\FacebookUserDto;
    
    use Processus\Lib\Mvo\UserMvo;

    class FacebookUserMvo extends UserMvo
    {

        /**
         * @return mixed
         */
        protected function getDataBucketPort ()
        {
            $config = $this->getApplication()
                ->getRegistry()
                ->getProcessusConfig()
                ->getCouchbaseConfig()
                ->getCouchbasePortByDatabucketKey("fbusers");
            
            return $config['port'];
        }

        /**
         * @param $mId
         * @return FacebookUserMvo
         */
        public function setMemId ($mId)
        {
            parent::setMemId("FacebookUserMvo_" . $mId);
            return $this;
        }

        /**
         * @return \Processus\Dto\FacebookUserDto
         */
        public function getDefaultDto ()
        {
            $dto = new FacebookUserDto();
            $dto->setData($this->getData());
            return $dto;
        }

        /**
         * @param string $size
         * @return string
         */
        public function getFacebookUserImageUrl(string $size)
        {
            return 'https://graph.facebook.com/' . $this->getFacebookUserId() . '/picture?type=' . $size;
        }

        /**
         * @return mixed
         */
        public function getFacebookUserId()
        {
            return $this->getApplication()->getFacebookClient()->getUserId();
        }
    }

}
?>