<?php

namespace Mike\CharacterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mike\CharacterBundle\Entity\Attributes;
use Mike\CharacterBundle\Form\AttributesType;

/**
 * Attributes controller.
 *
 * @Route("/attributes")
 */
class AttributesController extends Controller
{

    /**
     * Lists all Attributes entities.
     *
     * @Route("/", name="attributes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MikeCharacterBundle:Attributes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Attributes entity.
     *
     * @Route("/", name="attributes_create")
     * @Method("POST")
     * @Template("MikeCharacterBundle:Attributes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Attributes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attributes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Attributes entity.
     *
     * @param Attributes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Attributes $entity)
    {
        $form = $this->createForm(new AttributesType(), $entity, array(
            'action' => $this->generateUrl('attributes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }

    /**
     * Displays a form to create a new Attributes entity.
     *
     * @Route("/new", name="attributes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Attributes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Attributes entity.
     *
     * @Route("/{id}", name="attributes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Attributes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attributes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Attributes entity.
     *
     * @Route("/{id}/edit", name="attributes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Attributes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attributes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Attributes entity.
    *
    * @param Attributes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Attributes $entity)
    {
        $form = $this->createForm(new AttributesType(), $entity, array(
            'action' => $this->generateUrl('attributes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }
    /**
     * Edits an existing Attributes entity.
     *
     * @Route("/{id}", name="attributes_update")
     * @Method("PUT")
     * @Template("MikeCharacterBundle:Attributes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Attributes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attributes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('attributes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Attributes entity.
     *
     * @Route("/{id}", name="attributes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MikeCharacterBundle:Attributes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Attributes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attributes'));
    }

    /**
     * Creates a form to delete a Attributes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attributes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-default btn-xs')))
            ->getForm()
        ;
    }
}
