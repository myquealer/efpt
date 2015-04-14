<?php

namespace Mike\CharacterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mike\CharacterBundle\Entity\CharacterAttributes;
use Mike\CharacterBundle\Form\CharacterAttributesType;

/**
 * CharacterAttributes controller.
 *
 * @Route("/characterattributes")
 */
class CharacterAttributesController extends Controller
{

    /**
     * Lists all CharacterAttributes entities.
     *
     * @Route("/", name="characterattributes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MikeCharacterBundle:CharacterAttributes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CharacterAttributes entity.
     *
     * @Route("/", name="characterattributes_create")
     * @Method("POST")
     * @Template("MikeCharacterBundle:CharacterAttributes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CharacterAttributes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('characterattributes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CharacterAttributes entity.
     *
     * @param CharacterAttributes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CharacterAttributes $entity)
    {
        $form = $this->createForm(new CharacterAttributesType(), $entity, array(
            'action' => $this->generateUrl('characterattributes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }

    /**
     * Displays a form to create a new CharacterAttributes entity.
     *
     * @Route("/new", name="characterattributes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CharacterAttributes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CharacterAttributes entity.
     *
     * @Route("/{id}", name="characterattributes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:CharacterAttributes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharacterAttributes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CharacterAttributes entity.
     *
     * @Route("/{id}/edit", name="characterattributes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:CharacterAttributes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharacterAttributes entity.');
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
    * Creates a form to edit a CharacterAttributes entity.
    *
    * @param CharacterAttributes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CharacterAttributes $entity)
    {
        $form = $this->createForm(new CharacterAttributesType(), $entity, array(
            'action' => $this->generateUrl('characterattributes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }
    /**
     * Edits an existing CharacterAttributes entity.
     *
     * @Route("/{id}", name="characterattributes_update")
     * @Method("PUT")
     * @Template("MikeCharacterBundle:CharacterAttributes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:CharacterAttributes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharacterAttributes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('characterattributes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CharacterAttributes entity.
     *
     * @Route("/{id}", name="characterattributes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MikeCharacterBundle:CharacterAttributes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CharacterAttributes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('characterattributes'));
    }

    /**
     * Creates a form to delete a CharacterAttributes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('characterattributes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-default btn-xs')))
            ->getForm()
        ;
    }
}
