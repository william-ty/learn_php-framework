<?php

namespace Novus\Model;

class Content
{
  private $id;
  private $userId;
  private $contentType;
  private $name;
  private $data;
  private $createdAt;
  private $updatedAt;

  public function __construct(
    $id,
    $userId,
    $contentType,
    $name,
    $data,
    $createdAt,
    $updatedAt
    )
  {
    $this->id = $id;
    $this->userId = $userId;
    $this->contentType = $contentType;
    $this->name = $name;
    $this->data = $data;
    $this->createdAt = $createdAt;
    $this->updatedAt = $updatedAt;
  }


  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of userId
   */
  public function getUserId()
  {
    return $this->userId;
  }


  /**
   * Set the value of userId
   *
   * @return  self
   */
  public function setUserId($userId)
  {
    $this->userId = $userId;

    return $this;
  }

  /**
   * Get the value of contentType
   */
  public function getContentType()
  {
    return $this->contentType;
  }

  /**
   * Set the value of contentType
   *
   * @return  self
   */
  public function setContentType($contentType)
  {
    $this->contentType = $contentType;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName()
  {
    return ucfirst($this->name);
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of data
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * Set the value of data
   *
   * @return  self
   */
  public function setData($data)
  {
    $this->data = $data;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of updatedAt
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * Set the value of updatedAt
   *
   * @return  self
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

}