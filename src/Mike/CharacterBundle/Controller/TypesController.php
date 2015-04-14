<?php

namespace Mike\CharacterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mike\CharacterBundle\Entity\Types;
use Mike\CharacterBundle\Form\TypesType;

/**
 * Types controller.
 *
 * @Route("/types")
 */
class TypesController extends Controller
{

    /**
     * Lists all Types entities.
     *
     * @Route("/", name="types")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MikeCharacterBundle:Types')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Types entity.
     *
     * @Route("/", name="types_create")
     * @Method("POST")
     * @Template("MikeCharacterBundle:Types:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Types();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('types_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Types entity.
     *
     * @param Types $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Types $entity)
    {
        $form = $this->createForm(new TypesType(), $entity, array(
            'action' => $this->generateUrl('types_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }

    /**
     * Displays a form to create a new Types entity.
     *
     * @Route("/new", name="types_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Types();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Types entity.
     *
     * @Route("/{id}", name="types_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Types')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Types entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Types entity.
     *
     * @Route("/{id}/edit", name="types_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Types')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Types entity.');
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
    * Creates a form to edit a Types entity.
    *
    * @param Types $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Types $entity)
    {
        $form = $this->createForm(new TypesType(), $entity, array(
            'action' => $this->generateUrl('types_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }
    /**
     * Edits an existing Types entity.
     *
     * @Route("/{id}", name="types_update")
     * @Method("PUT")
     * @Template("MikeCharacterBundle:Types:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Types')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Types entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('types_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Types entity.
     *
     * @Route("/{id}", name="types_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MikeCharacterBundle:Types')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Types entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('types'));
    }

    /**
     * Creates a form to delete a Types entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('types_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-default btn-xs')))
            ->getForm()
        ;
    }
}
