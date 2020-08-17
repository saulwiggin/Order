<?php
namespace App\Controller;
 
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Util\RedisHelper;
 
/**
 * @Route("/redis", service="app.controller.redis")
 */
class RedisController
{
    private $redisHelper;
 
    public function __construct(RedisHelper $redis_helper)
    {
        $this->redisHelper = $redis_helper;
    }
 
    /**
     * @param Request $request
     *
     * @Method({"GET"})
     * @Route("/set")
     *
     * @return Response
     */
    public function setAction(Request $request)
    {
        $key = $request->query->get('key');
        $value = $request->query->get('value');
        $ttl = $request->query->get('ttl');
 
        $result = null;
 
        try {
            if ($key && $value) {
                $this->redisHelper->set($key, $value, $ttl);
                $result = ['key' => $key, 'value' => $value, 'ttl' => $ttl];
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
 
        return new Response(json_encode($result));
    }
 
    /**
     * @param Request $request
     *
     * @Method({"GET"})
     * @Route("/get")
     *
     * @return Response
     */
    public function getAction(Request $request)
    {
        $key = $request->query->get('key');
 
        $result = null;
 
        try {
            if ($key) {
                $result = ['key' => $key, 'value' => $this->redisHelper->get($key)];
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
 
        return new Response(json_encode($result));
    }
 
    /**
     * @param Request $request
     *
     * @Method({"GET"})
     * @Route("/ttl")
     *
     * @return Response
     */
    public function ttlAction(Request $request)
    {
        $key = $request->query->get('key');
 
        $result = null;
 
        try {
            if ($key) {
                $result = ['key' => $key, 'ttl' => $this->redisHelper->getTtl($key)];
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
 
        return new Response(json_encode($result));
    }
 
    /**
     * @param Request $request
     *
     * @Method({"GET"})
     * @Route("/persist")
     *
     * @return Response
     */
    public function persistAction(Request $request)
    {
        $key = $request->query->get('key');
 
        $result = null;
 
        try {
            if ($key) {
                $result = ['key' => $key, 'persist' => $this->redisHelper->persist($key)];
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
 
        return new Response(json_encode($result));
    }
 
    /**
     * @param Request $request
     *
     * @Method({"GET"})
     * @Route("/expire")
     *
     * @return Response
     */
    public function expireAction(Request $request)
    {
        $key = $request->query->get('key');
        $ttl = $request->query->get('ttl');
 
        $result = null;
 
        try {
            if ($key) {
                $result = ['key' => $key, 'expire' => $this->redisHelper->expire($key, $ttl)];
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
 
        return new Response(json_encode($result));
    }
 
    /**
     * @param Request $request
     *
     * @Method({"GET"})
     * @Route("/delete")
     *
     * @return Response
     */
    public function deleteAction(Request $request)
    {
        $key = $request->query->get('key');
 
        $result = null;
 
        try {
            if ($key) {
                $result = ['key' => $key, 'expire' => $this->redisHelper->delete($key)];
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
 
        return new Response(json_encode($result));
    }
}